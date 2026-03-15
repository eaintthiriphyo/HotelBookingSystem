<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request,$user){
        if($user->role==='admin'){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }

    protected function sendFailedLoginResponse(Request $request)
{
   $user = User::where('email', $request->email)->first();

    // Email not exist
    if(!$user){
        throw ValidationException::withMessages([
            'email' => ['Email not found.']
        ]);
    }

    // Password wrong
    throw ValidationException::withMessages([
        'password' => ['Password is incorrect.']
    ]);
}
}
