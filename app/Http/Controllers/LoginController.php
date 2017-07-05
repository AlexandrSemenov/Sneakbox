<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function register()
    {
        return view('login.register');
    }

    public function registerUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required|max:120',
            'password' => 'required|min:5'
        ], $messages = [
            'email.required' => 'Необходимо указать email',
            'username.required' => 'Необходимо указать имя',
            'password.required' => 'Необходимо указать пароль',
            'email.email' => 'Необходимо ввести коректный пароль',
            'max' => 'Кол-во символов не должно превышать 120',
            'min' => 'Минимальное кол-во символов 5',
            'email.unique' => 'Значение поля email должно быть уникальным'
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->reset_token = hash_hmac('sha256', str_random(40), config('app.key'));
        $user->save();

        $role = new Role();
        $role = $role::find(2);

        $role->users()->save($user);

        $notification = new Notification();
        $notification->user_id = $user->id;
        $notification->save();

        Auth::login($user);
        return redirect()->route('login.index');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], $messages = [
            'email.required' => 'Необходимо указать email',
            'password.required' => 'Необходимо указать пароль'
        ]);

        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            return redirect()->route('myprofile.index');
        }

        return redirect()->back()->with('message', "Неправильный логин или пароль");
    }

    public function loginAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], $messages = [
            'email.required' => 'Необходимо указать email',
            'password.required' => 'Необходимо указать пароль'
        ]);

        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']]) && Auth::user()->isAdmin())
        {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('message', "Неправильный логин или пароль");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

    public function passwordReset(Request $request)
    {

        if($request->isMethod('post')){
            $this->validate($request, [
                'email' => 'required|email|exists:users',
            ], [
                'email.required' => 'Необходимо указать email',
                'email.exists' => 'Этого email нет в базе',
            ]);

            $user = User::where('email', '=', $request['email'])->first();
            $url = Config::get('app.url');

            Mail::send('email.reset', array('user' => $user, 'url' => $url), function($message) use ($user){
                $message->from('info.sneakbox@gmail.com', 'Sneak.Box info');
                $message->to($user->email, $user->name)->subject('Запрос на изменения пароля на сайте Sneakbox.com.ua');
            });

            return redirect()->back()->with('notification', "Мы выслали вам инструкцию на почту");
        }

        return view('reset.index');
    }

    public function passwordResetForm(Request $request)
    {
        if($request->isMethod('post')){

            $token = $request->token;
            $user = User::where('reset_token', '=', $token)->first();
            if($user){
                $this->validate($request, [
                    'new_pass_1' => 'required',
                    'new_pass_2' => 'required|same:new_pass_1'
                ],[
                    'new_pass_1.required' => 'Необходимо указать пароль',
                    'new_pass_2.required' => 'Необходимо указать пароль',
                    'new_pass_2.same' => 'Введенные пароли не совпадают'
                ]);

                $user->password = Hash::make($request['new_pass_1']);
                $user->reset_token = hash_hmac('sha256', str_random(40), config('app.key'));
                $user->update();

                return redirect()->route('login.index');
            }
            return view('errors.reset-token');
        }
        return view('reset.password');
    }
}
