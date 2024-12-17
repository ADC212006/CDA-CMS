<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Add this line
use Auth;
use App\Models\Admin;
use App\Notifications\PasswordResetNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    //
    public function login(){
        return view('authentication.login');
    }
    public function loginSubmit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
        
            return response()->json(['success' => true, 'redirect_url' => route('slider.index')]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    public function logout()
    {
        Auth::guard('admin')->logout(); // Log the admin user out
    
        return redirect()->route('admin.login')->with('status', 'You have been logged out.'); // Redirect to admin login with a status message
    }
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:admins,email']);
    
        $admin = Admin::where('email', $request->email)->first();
    
        // Generate a simple 6-digit random number
        $token = rand(100000, 999999); // Generates a random number between 100000 and 999999
    
        DB::table('password_resets')->insert([
            'email' => $admin->email,
            'token' => $token, // Use the 6-digit random number as the token
            'created_at' => now(),
        ]);
    
        // Create the password reset link
        $url = url('admin/password/reset/' . $token); // Reset link with token
    
        // Send a simple email with the reset link and the token
        \Mail::raw("Click here to reset your password: $url", function ($message) use ($admin) {
            $message->to($admin->email)
                    ->subject('Password Reset Request');
        });
    
        return response()->json(['message' => 'Password reset link sent!']);
    }
    


    public function showResetForm($token)
    {
        return view('auth.admins.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $resetRecord = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$resetRecord) {
            return redirect()->route('admin.login')->with('error', 'Invalid token');
        }

        $admin = Admin::where('email', $resetRecord->email)->first();
        $admin->password = Hash::make($request->password);
        $admin->save();

        DB::table('password_resets')->where('token', $request->token)->delete();

        return redirect()->route('admin.login')->with('success', 'Password has been reset successfully');
    }

    public function updatePassword(Request $request)
    {
        // Ensure the admin is authenticated
        if (!auth()->guard('admin')->check()) {
            return response()->json(['message' => 'User not authenticated.'], 401);
        }

        // Get the authenticated admin
        $admin = auth()->guard('admin')->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $admin->password)) {
            return response()->json(['message' => 'Current password is incorrect.'], 400);
        }

        // Update the password
        $admin->password = Hash::make($request->password);
        $admin->save();

        return response()->json(['message' => 'Password has been updated successfully.']);
    }


}



