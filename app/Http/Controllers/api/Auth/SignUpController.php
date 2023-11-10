<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SignUpController extends Controller
{
    public function signup(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'telephone' => 'required|unique:users',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Generate a random 5-digit verification code
        $verificationCode = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        // Create the new user
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->telephone = $request->input('telephone');
        $user->verifycode = $verificationCode;
        $user->approve = 0;
        $user->save();

        // Send the verification email
        $emailContent = "Dear {$user->username},\n\n";
        $emailContent .= "Your verification code is: {$verificationCode}\n";
        $emailContent .= "Please use this code to verify your email address.";

        Mail::raw($emailContent, function ($message) use ($user) {
            $message->to($user->email)->subject('Email Verification');
        });

        return response()->json(['status' => 'success', 'message' => 'User created successfully', 'data' => $user], 200);
    }
}
