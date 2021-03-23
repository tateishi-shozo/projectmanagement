<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\License;
use App\Project;
use App\User;
use App\Profile;

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
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function authenticated(Request $request, $user)
    {
        if($user->profile == null){
            $this->redirectTo = 'user/profile/create';
        }elseif($user->is_admin == 2) {
            // 管理ユーザ
            $this->redirectTo = 'admin/project/index';
        } else {
            // 一般ユーザ
            return redirect(route('user.index', [
                'user' => $user->id,
            ]));
        }
    }
    
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}