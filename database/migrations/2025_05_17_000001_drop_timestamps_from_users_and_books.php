<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('users', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('books', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('books', function (Blueprint $table) {
            $table->timestamps();
        });
    }
}; 