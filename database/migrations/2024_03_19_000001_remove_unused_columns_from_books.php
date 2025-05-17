<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Remove is_available column if it exists
            if (Schema::hasColumn('books', 'is_available')) {
                $table->dropColumn('is_available');
            }
            
            // Remove timestamps if they exist
            if (Schema::hasColumn('books', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('books', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Add back the columns if needed to rollback
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }
}; 