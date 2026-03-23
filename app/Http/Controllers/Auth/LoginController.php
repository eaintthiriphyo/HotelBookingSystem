<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // ✅ ADD THIS

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        // Only protect login/logout, leave welcome page open
        $this->middleware('guest')->only('showLoginForm', 'login');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {

   if ($user->role !== 'admin' && $user->status != 2  && $user->status != 1) {
    Auth::logout();
    return redirect()->route('login')
        ->with('error', 'Your account is not approved yet!');
}




        if ($user->role === 'admin') {
            return redirect()->route('admin.viewDashboard');
        }
        return redirect()->route('user.dashboard');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Email not found.']
            ]);
        }

        throw ValidationException::withMessages([
            'password' => ['Password is incorrect.']
        ]);
    }
}
