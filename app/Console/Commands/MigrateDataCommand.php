<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Throwable;

class MigrateDataCommand extends Command
{
    protected $signature = 'data:migrate 
        {--from= : Source connection name (default: default DB_CONNECTION)} 
        {--to=analytics_mysql : Target connection name} 
        {--tables= : Comma separated table list (default: detected core tables)} 
        {--chunk=500 : Chunk size for copying rows} 
        {--fresh : Drop & recreate target tables before copy}';

    protected $description = 'Copy application data from one database connection to another (for analytics / visualization).';

    protected array $defaultTables = [
        'users','categories','menu_items','products','orders','order_items','reviews','contacts'
    ];

    public function handle(): int
    {
        $from = $this->option('from') ?: config('database.default');
        $to = $this->option('to') ?: 'analytics_mysql';
        $chunk = (int) $this->option('chunk');
        $tablesOpt = $this->option('tables');
        $tables = $tablesOpt ? array_map('trim', explode(',', $tablesOpt)) : $this->defaultTables;
        $fresh = (bool) $this->option('fresh');

        $this->info("Starting data migration: {$from} -> {$to}");
        $this->line('Tables: '.implode(', ', $tables));

        // Validate connections
        foreach ([$from,$to] as $conn) {
            try { DB::connection($conn)->getPdo(); } catch (Throwable $e) { $this->error("Connection '{$conn}' failed: {$e->getMessage()}"); return self::FAILURE; }
        }

        foreach ($tables as $table) {
            $this->migrateTable($from, $to, $table, $chunk, $fresh);
        }

        $this->info('Done.');
        return self::SUCCESS;
    }

    protected function migrateTable(string $from, string $to, string $table, int $chunk, bool $fresh): void
    {
        $src = DB::connection($from);
        $dst = DB::connection($to);

        if (!$src->getSchemaBuilder()->hasTable($table)) {
            $this->warn("[skip] Source table missing: {$table}");
            return;
        }

        // Attempt to replicate schema if target missing or --fresh
        if ($fresh || !$dst->getSchemaBuilder()->hasTable($table)) {
            if ($fresh && $dst->getSchemaBuilder()->hasTable($table)) {
                $this->line(" - Dropping existing target table {$table}");
                $dst->getSchemaBuilder()->drop($table);
            }
            $this->replicateSchema($src, $dst, $table);
        }

        $total = $src->table($table)->count();
        $this->line(" - Copying {$table} ({$total} rows)...");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $dst->table($table)->truncate();

        $src->table($table)->orderBy('id')->chunk($chunk, function($rows) use ($dst, $table, $bar) {
            $insert = [];
            foreach ($rows as $row) {
                $insert[] = (array) $row;
            }
            if ($insert) { $dst->table($table)->insert($insert); }
            $bar->advance(count($insert));
        });

        $bar->finish();
        $this->newLine();
    }

    protected function replicateSchema($src, $dst, string $table): void
    {
        // Very lightweight: fetch columns via pragma (sqlite) or information_schema (mysql)
        $driver = $src->getDriverName();
        $cols = [];
        if ($driver === 'sqlite') {
            $cols = $src->select("PRAGMA table_info('$table')");
        } else {
            $database = $src->getDatabaseName();
            $cols = $src->select("SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? ORDER BY ORDINAL_POSITION", [$database, $table]);
        }
        if (!$cols) { $this->warn("   ! Cannot introspect columns for {$table}; create manually."); return; }

        $this->line(" - (Re)creating target schema for {$table}");
        // NOTE: This is simplistic. For production use, rely on migrations executed against both connections.
        $dst->getSchemaBuilder()->create($table, function(Blueprint $blueprint) use ($cols, $driver) {
            foreach ($cols as $c) {
                if ($driver === 'sqlite') {
                    $name = $c->name ?? $c->Name ?? $c->column_name ?? $c->COLUMN_NAME;
                    $type = strtolower($c->type ?? $c->Type ?? 'text');
                } else {
                    $name = $c->COLUMN_NAME;
                    $type = strtolower($c->DATA_TYPE);
                }
                // Map generic types
                switch (true) {
                    case str_contains($type,'int'): $col = $blueprint->bigInteger($name)->nullable(); break;
                    case str_contains($type,'char') || str_contains($type,'text'): $col = $blueprint->text($name)->nullable(); break;
                    case str_contains($type,'double') || str_contains($type,'float') || str_contains($type,'real'): $col = $blueprint->double($name)->nullable(); break;
                    case str_contains($type,'decimal'): $col = $blueprint->decimal($name, 15, 2)->nullable(); break;
                    case str_contains($type,'date') || str_contains($type,'time'): $col = $blueprint->dateTime($name)->nullable(); break;
                    default: $col = $blueprint->string($name, 191)->nullable();
                }
                if ($name === 'id') { $blueprint->bigIncrements('id'); }
            }
        });
    }
}
