<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all admin users
        $adminUsers = User::where('role', 'admin')->get();
        
        // If there are multiple admin users, keep only the first one
        if ($adminUsers->count() > 1) {
            $firstAdmin = $adminUsers->first();
            User::where('role', 'admin')
                ->where('id', '!=', $firstAdmin->id)
                ->update(['role' => 'member']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this migration
    }
}; 