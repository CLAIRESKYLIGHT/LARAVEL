<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function stats(): JsonResponse
    {
        $stats = [
            'total_books' => Book::count(),
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_members' => User::where('role', 'member')->count(),
            'category_distribution' => Book::selectRaw('category, count(*) as count')
                ->groupBy('category')
                ->pluck('count', 'category')
                ->toArray(),
            'recent_activity' => $this->getRecentActivity(),
        ];

        return response()->json(['data' => $stats]);
    }

    private function getRecentActivity()
    {
        // Implement your recent activity logic here
        // This could be from a separate activity log table
        return [];
    }
}