<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\{Schema, DB};

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        
        DB::table('users')->truncate();  // Resets auto-increment
        DB::table('categories')->truncate();
        
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1');
        
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        // Optional: Rollback logic if needed
    }
};

