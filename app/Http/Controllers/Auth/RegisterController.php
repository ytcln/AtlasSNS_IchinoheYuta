<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        if($request->isMethod('post')){

            //ユーザー登録時のバリデーションを設定する
            $data = $request->all();
            $validated=$request->validate([
                'username'=>'required|min:2|max:12',
                'mail'=>'required|email|min:5|max:40|unique:users,mail',
                'password'=>'required|alpha_num|min:8|max:20|confirmed',
            ],[
                'username.required' => 'ユーザー名を入力してください',
                'mail.required' => 'メールを入力してください',
                'password.required' => '英数字8文字から20文字までです',
            ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            // セッションを使用してユーザー名を表示させる
            $request->session()->put('username',$username);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        $value = session('username');
        return view('auth.added');
    }
}
