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
        DB::table('users')->delete();
        DB::table('categories')->delete();
        
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1001');
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 2001');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not reversible - consider logging a warning
        // or implementing alternative rollback logic
    }
};
