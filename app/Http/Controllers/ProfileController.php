<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth('sanctum')->user();
        $role = match (get_class($user)) {
            \App\Models\Admin::class => 'admin',
            \App\Models\User::class => 'user',
            default => 'unknown',
        };

        return ApiResponse::success(['role' => $role, 'user' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return ApiResponse::success(null, 'Logged out successfully');

    }
}
