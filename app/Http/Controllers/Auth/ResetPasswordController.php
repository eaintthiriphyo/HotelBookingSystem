<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    // You can keep redirectTo but we won't auto-login
    protected $redirectTo = '/login';

    /**
     * Override the resetPassword method from ResetsPasswords
     */
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();

        // Do NOT log the user in automatically
        // Auth::login($user); // remove this line

        // Now redirect manually in sendResetResponse
    }

    /**
     * Override sendResetResponse to redirect to login with success message
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect()->route('login')->with('success', 'Password reset successfully! Please login.');
    }

    /**
     * Override sendResetFailedResponse to handle errors
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return back()->withErrors(['email' => trans($response)]);
    }
}
