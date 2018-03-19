<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if(Auth::user())
        {
            $products = Product::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(10);

            return view('myprofile.index', ['products' => $products]);
        }
    }
    public function userUpdate(Request $request)
    {
        $this->validate($request, [
            'city' => 'alpha|max:120',
            'full_name' => 'max:255',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/'
        ],[
            'city.alpha' => 'В названии города должны быть только буквы',
            'city.max' => 'В названии города должно быть не больше 120 символов',
            'full_name.max' => 'В имени должны быть не больше 255 символов',
            'phone.regex' => 'Телефон должен содержать только цифры'
        ]);

        $user = User::find(Auth::user()->id);
        $user->city = $request['city'];
        $user->full_name = $request['full_name'];
        $user->phone = $request['phone'];

        if($user->update())
        {
            $message = "Вы обновили учетную запись";
        }


        return redirect()->route('profile.settings')->with('message', $message);

    }

    public function passUpdate(Request $request)
    {
        $this->validate($request, [
            'new_pass_1' => 'required',
            'new_pass_2' => 'required|same:new_pass_1'
        ],[
            'new_pass_1.required' => 'Необходимо указать пароль',
            'new_pass_2.required' => 'Необходимо указать пароль',
            'new_pass_2.same' => 'Введенные пароли не совпадают'
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request['new_pass_1']);

        if($user->update())
        {
            $message2 = "Вы обновили пароль";
        }

        return redirect()->route('profile.settings')->with('message2', $message2);
    }

    public function messagesAnswer()
    {
        return view('myprofile.messages-answer');
    }

    public function messagesSend()
    {
        return view('myprofile.messages-send');
    }


    public function profileSettings()
    {
        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);
            $user_notifications = Notification::where('user_id', '=', Auth::user()->id)->first();
            return view('myprofile.settings', ['user' => $user, 'notifications' => $user_notifications]);
        }
        return view('login.index');
    }

    public function notifyUpdate(Request $request)
    {
        $this->validate($request, [
            'message_notification' => 'required|boolean',
            'information_notification' => 'required|boolean',
            'news_notification' => 'required|boolean',
        ], [
            'message_notification.boolean' => 'Неправильный тип значения (bool)',
            'information_notification.boolean' => 'Неправильный тип значения (bool)',
            'news_notification.boolean' => 'Неправильный тип значения (bool)',
        ]);

        $user_notifications = Notification::where('user_id', '=', Auth::user()->id)->first();

        $user_notifications->message_notification = $request['message_notification'];
        $user_notifications->information_notification = $request['information_notification'];
        $user_notifications->news_notification = $request['news_notification'];
        $user_notifications->update();

        return redirect()->route('profile.settings');

    }
}
