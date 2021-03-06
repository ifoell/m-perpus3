<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/home';
    // protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
        // $this->username = $this->findUsername();
    }

    // public function findUsername()
    // {
    //     $login = request()->input('login');
    //     $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    //     request()->merge([$fieldType => $login]);
    //     return $fieldType;
    // }

    // public function username()
    // {
    //     return 'username';
    // }

    public function login(Request $request)
    {
        $input = $request->all();

        $user = User::where('username',$request->username)->first();
        if( $user && $user->is_active == 'n'){
            return redirect()->back()->with('error','the user has been desactivated');
        }

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',

        ]);

        $remember = $request->has('remember') ? true : false;

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password']), $remember))
        {
            return redirect()->route('dashboard')
                ->with('success', 'Welcome to M-Perpus!');
        }else{
            return redirect()->back()
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }

    public function locked()
    {
        if (!session('lock-expires-at')) {
            return redirect('/');
        }

        if (session('lock-expires-at') > now()) {
            return redirect('/');
        }

        return view('auth.locked');
    }

    public function unlock(Request $request)
    {
        $check = Hash::check($request->input('password'), $request->user()->password);

        if (!$check) {
            return redirect()->back()->with('error','Password doesn\'t match');
        }

        session(['lock-expires-at' => now()->addMinutes($request->user()->getLockoutTime())]);

        return redirect()->back()->with('success','Welcome Back');
    }
}