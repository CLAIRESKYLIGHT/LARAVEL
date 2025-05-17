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
        // Remove price column from books table if it exists
        if (Schema::hasColumn('books', 'price')) {
            Schema::table('books', function (Blueprint $table) {
                $table->dropColumn('price');
            });
        }

        // Remove transaction-related tables if they exist
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('borrowings');

        // Remove any transaction-related columns from books table
        if (Schema::hasColumn('books', 'transaction_id')) {
            Schema::table('books', function (Blueprint $table) {
                $table->dropColumn('transaction_id');
            });
        }

        // Remove any borrowing-related columns from books table
        if (Schema::hasColumn('books', 'borrowing_id')) {
            Schema::table('books', function (Blueprint $table) {
                $table->dropColumn('borrowing_id');
            });
        }

        // Remove any fine-related columns from users table
        if (Schema::hasColumn('users', 'fine_amount')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('fine_amount');
            });
        }

        // Remove any borrowing history columns from users table
        if (Schema::hasColumn('users', 'borrowing_history')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('borrowing_history');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: We don't restore the removed data in the down method
        // as it's better to keep the database clean
    }
}; 