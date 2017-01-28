<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
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
        $user->save();

        $role = new Role();
        $role = $role::find(2);

        $role->users()->save($user);

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
}
