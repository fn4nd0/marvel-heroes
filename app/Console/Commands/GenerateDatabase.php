<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dbname = env('DB_DATABASE');

        // Check if the database exists
        if (!Schema::hasDatabase($dbname)) {
            $charset = env('DB_CHARSET', 'utf8mb4');
            $collation = env('DB_COLLATION', 'utf8mb4_unicode_ci');
            $sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET $charset COLLATE $collation;";
            DB::statement($sql);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $dbname = env('DB_DATABASE');
        $sql = "DROP DATABASE IF EXISTS `$dbname`;";
        DB::statement($sql);
    }
}
