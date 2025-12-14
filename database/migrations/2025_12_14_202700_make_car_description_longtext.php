<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('cars', 'description')) {
            Schema::table('cars', function (Blueprint $table) {
                $table->longText('description')->nullable();
            });
            return;
        }

        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement('ALTER TABLE `cars` MODIFY `description` LONGTEXT NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE "cars" ALTER COLUMN "description" TYPE TEXT');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('cars', 'description')) {
            return;
        }

        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement('ALTER TABLE `cars` MODIFY `description` TEXT NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE "cars" ALTER COLUMN "description" TYPE VARCHAR(65535)');
        }
    }
};
