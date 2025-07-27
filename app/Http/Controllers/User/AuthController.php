<?php

namespace App\Http\Controllers\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string|min:6'
            ]);
            if ($validator->fails()) {
                return ApiResponse::error($validator->errors(), 422);
            }

            $admin = User::where('email', $request->email)->first();
            if (!$admin || !Hash::check($request->password, $admin->password)) {
                return ApiResponse::error('Invalid credentials', 401);
            }

            $token = $admin->createToken('admin-token')->plainTextToken;

            return ApiResponse::success(['token' => $token], 'Login Successfully');

        } catch (\Exception $exception) {
            return ApiResponse::error(null, 500, $exception->getMessage());
        }

    }
}
