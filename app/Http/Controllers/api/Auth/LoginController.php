<?php

namespace App\Http\Controllers\api\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class LoginController
{
public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Get the user by email
        $user = User::where('email', $request->input('email'))->first();

        // Check if the user exists
        if (!$user) {
            return response()->json(['error' => 'User does not exist'], 404);
        }

        // Check if the password is correct
        if (!password_verify($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Password is wrong'], 401);
        }


        return response()->json(['status' => 'success', 'message' => 'User login successfully', 'data' => $user], 200);
    }
}
