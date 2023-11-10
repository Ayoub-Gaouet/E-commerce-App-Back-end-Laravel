<?php

namespace App\Http\Controllers\api\Auth\ForgetPassword;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CheckEmailController extends Controller
{
    public function checkEmail(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Check if the email exists
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->json(['error' => 'User does not exist'], 404);
        }

        // Check if the user is verified
        if (!$user->approve) {
            return response()->json(['error' => 'User is not verified'], 401);
        }

        // Generate a random 5-digit verification code
        $verificationCode = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        //change the user's verifycode
        $user = User::where('email', $request->input('email'))->first();
        $user->verifycode = $verificationCode;
        $user->save();

        // Send the verification email
        $emailContent = "Dear {$user->username},\n\n";
        $emailContent .= "Your verification code is: {$verificationCode}\n";
        $emailContent .= "Please use this code to verify your email address.";

        Mail::raw($emailContent, function ($message) use ($user) {
            $message->to($user->email)->subject('Email Verification');
        });

        // Return success response
        return response()->json(['status' => 'success', 'message' => 'Email is available'], 200);
    }
}
