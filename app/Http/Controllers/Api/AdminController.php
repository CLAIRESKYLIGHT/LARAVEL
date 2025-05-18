<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Get all users.
     */
    public function users(): JsonResponse
    {
        $users = User::all();
        return response()->json(['data' => $users]);
    }

    /**
     * Create a new user.
     */
    public function createUser(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:member',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
        ]);

        return response()->json(['data' => $user], 201);
    }

    /**
     * Update a user.
     */
    public function updateUser(Request $request, User $user): JsonResponse
    {
        if ($user->role === 'admin') {
            return response()->json(['message' => 'Cannot modify admin user'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'sometimes|required|in:member',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->update($request->only(['name', 'email', 'role']));
        return response()->json(['data' => $user]);
    }

    /**
     * Delete a user.
     */
    public function deleteUser(User $user): JsonResponse
    {
        if ($user->role === 'admin') {
            return response()->json(['message' => 'Cannot delete admin user'], 403);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    /**
     * Get all transactions.
     */
    public function transactions(): JsonResponse
    {
        $transactions = Transaction::with(['user', 'book'])->get();
        return response()->json(['data' => $transactions]);
    }

    /**
     * Get dashboard statistics.
     */
    public function dashboard(): JsonResponse
    {
        $stats = [
            'total_users' => User::count(),
            'total_books' => Book::count(),
            'total_members' => User::where('role', 'member')->count(),
        ];

        return response()->json(['data' => $stats]);
    }
} 