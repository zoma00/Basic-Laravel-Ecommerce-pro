<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToBrandsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            // Check if the column does not exist before adding it
            if (!Schema::hasColumn('brands', 'deleted_at')) {
                $table->timestamp('deleted_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            // Remove the column if it exists
            if (Schema::hasColumn('brands', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }
}
