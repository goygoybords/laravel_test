<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator, Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;



class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|min:6|unique:users',
            'password' => 'required|min:6|confirmed|alpha_num',
            'password_confirmation'=> 'required|min:6',
            'terms' => 'accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    // my function could also use built in
    public function getLogin()
    {
        $title = "Login Page";
        return view('login')->with(compact('title'));
    }
    public function getRegister()
    {
        $title = "Register Page";
        return view('register')->with(compact('title'));
    }

    public function postLogin(Request $request)
    {
        $rules = ['username' => 'required' , 'password' => 'required'];
        $this->validate($request,$rules);

        $credentials = [
                        'username' => $request->input('username'), 
                        'password' => $request->input('password'),
                        'status'   => 1
                    ];
        
        if (Auth::attempt($credentials, $request->has('remember_me'))) 
        {
            return redirect()->intended($this->redirectPath());
        }
      
        return redirect('user/login')
            ->withInput($request->only('username', 'remember_me'))
            ->withErrors([
                'username' => $this->getFailedLoginMessage(),
            ]);
    }
    /**
    *   My Function but use the built in one
    *
    */
    // public function postRegister(Request $request)
    // {
    //     $data = $request->only('username', 'password' , 'password_confirmation' ,'terms');

    //     if($this->validator($data)->fails())
    //     {
    //        $messages = $this->validator($data)->messages(); 
    //        return redirect('user/register')
    //        ->withErrors($messages)
    //        ->withInput($request->except('password'));
    //     }
    //     else
    //     {
    //         $user = new User;
    //         $user->username = $request->input('username');
    //         $user->password = bcrypt($request->input('password'));
    //         $user->status = User::STATUS_ACTIVE;
    //         $result = $user->save();
          
    //         /**
    //         *
    //         * could also use this function to save data but 
    //         * this is not the best practice
    //         * $create = $this->create($data); 
    //         */
            
    //         if($result)
    //         {
    //             $msg = "User Record Saved";
    //             Auth::login($user);
    //             return redirect($this->redirectPath());
    //         }
    //     }       
    // }


    protected function create(array $data)
    {  
        $user = new User;
        $user->username = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        return $user;
       // return true;
        // return User::create([
        //     'username' => $data['username'],
        //     'password' => bcrypt($data['password']),
        //     // 'status' => $data['status'],
        //     'status' => 1,
        // ]);
    }
}
