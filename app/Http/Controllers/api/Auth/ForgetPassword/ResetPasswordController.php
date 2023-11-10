<?php

namespace App\Http\Controllers\api\Auth\ForgetPassword;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function ResetPassword(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->input('email'))->first();

        //modify the user's password
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Return success response
        return response()->json(['status' => 'success', 'message' => 'Password is changed'], 200);
    }
}
