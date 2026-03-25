<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DropAllTables extends Command
{
    protected $signature = 'db:drop-all';
    protected $description = 'Drop all tables in the current database';

    public function handle()
    {
        $database = config('database.connections.' . config('database.default') . '.database');
        if (!$database) {
            $this->error('No database selected.');
            return;
        }

        if (app()->environment('production')) {
            $this->error('This command is not allowed in production!');
            return;
        }

        $this->warn("Dropping all tables in database: {$database}");

        Schema::disableForeignKeyConstraints();

        $tables = DB::select('SHOW TABLES');
        $key = 'Tables_in_' . $database;

        foreach ($tables as $table) {
            $tableName = $table->$key;
            DB::table($tableName)->truncate(); // optional if you just want to truncate
            Schema::drop($tableName);
            $this->info("Dropped table: {$tableName}");
        }

        Schema::enableForeignKeyConstraints();

        $this->info('All tables dropped successfully.');
    }
}
