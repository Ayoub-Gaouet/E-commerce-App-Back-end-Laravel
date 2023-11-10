<?php

namespace App\Http\Controllers\api\Auth\ForgetPassword;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerifyCodeController extends Controller
{
    public function verifyCode(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'verifycode' => 'required|numeric',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        // Get the user by email
        $user = User::where('email', $request->input('email'))->first();

        // Check if the verification code is correct
        if ($user->verifycode != $request->input('verifycode')) {
            return response()->json(['error' => 'Verification code is wrong'], 401);
        }

        return response()->json(['status' => 'success', 'message' => 'Verification code is correct'], 200);
    }
}
