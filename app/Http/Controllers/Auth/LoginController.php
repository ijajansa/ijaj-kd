<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm(Request $request)
    {
        $categories = Category::where('is_active',1)->orderBy('name','ASC');
        if($request->system=="gvp_monitoring")
            $categories = $categories->where('type',1);
        else
            $categories = $categories->where('type',2);
        $categories = $categories->get();

        return view('auth.user-login',compact('categories'));
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email'=> 'required|exists:users,email',
            'password'=> 'required',
            'category_id'=> 'required',
        ],[
            'category_id.required' => 'The category field is required.'            
        ]);
        $user = User::where('email', $request->email)->where('category_id',$request->category_id)->where('role_id',2)->first();
        if($user) 
        {
            if($user && $user->is_active== 0)
            {
                return redirect()->back()->withErrors(['email'=> 'The account is disabled by admin.'])->withInput();
            }
            if(!Hash::check($request->password, $user->password))
            {
                return redirect()->back()->withErrors(['password'=> 'Password doest not match'])->withInput();
            }
            else
            {
                Auth::login($user);
                return redirect('dashboard');
            }
        }
        else
        {
            return redirect()->back()->withErrors(['email'=> 'The email address not exists.'])->withInput();
        }
    

    }
}
