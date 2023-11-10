<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class VerifyCodeSignUpController extends Controller
{
    public function verifyCodeSignUp(Request $request)
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

        // Check if the user exists
        if (!$user) {
            return response()->json(['error' => 'User does not exist'], 404);
        }

        // Check if the verification code is correct
        if ($user->verifycode != $request->input('verifycode')) {
            return response()->json(['error' => 'Verification code is wrong'], 401);
        }

        // Update the user's approve status
        $user->approve = 1;
        $user->save();

        return response()->json(['status' => 'success', 'message'=> 'User verified successfully'], 200);
    }
    public function resend(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
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

        // Generate a new 5-digit verification code
        $newVerificationCode = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        // Update the user's verifycode with the new code
        $user->verifycode = $newVerificationCode;
        $user->save();

        // Send the new verification code via email
        $emailContent = "Dear {$user->username},\n\n";
        $emailContent .= "Your new verification code is: {$newVerificationCode}\n";
        $emailContent .= "Please use this code to verify your email address.";

        Mail::raw($emailContent, function ($message) use ($user) {
            $message->to($user->email)->subject('New Verification Code');
        });

        return response()->json(['status' => 'success', 'message' => 'New verification code sent successfully'], 200);
    }
}
