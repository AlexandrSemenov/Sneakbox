<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Mail;

class MessageController extends Controller
{
    public function saveMessage(Request $request)
    {
        if(Auth::user())
        {
            /* проверяем создан ли разговор ранее */
            $conv = DB::table('conversations')->where('product_id', $request['product_id'])->where('user_id', Auth::user()->id)->get();

            /* валидация сообшения */
            $rules = ['message' => 'required|max:1000'];
            $messages = ['message.required' => 'Поле обязательное для заполнения',
                'message.max' => 'Максимальное число символов 1000'
            ];

            $this->validate($request, $rules, $messages);

            if(count($conv) > 0)
            {
                $mes = new Message();
                $mes->message = $request['message'];
                $mes->user_id= Auth::user()->id;
                $mes->conversation_id =  Auth::user()->conversations()->where('product_id', $request['product_id'])->get()->first()->id;
                $mes->product_id = $request['product_id'];
                $mes->send = Auth::user()->id;
                $mes->receive = $request['receive'];
                $mes->save();
            }else{
                $conversation = new Conversation();
                $conversation->subject = $request['subject'];
                $conversation->product_id = $request['product_id'];
                $conversation->user_id = Auth::user()->id;
                $conversation->send = Auth::user()->id;
                $conversation->receive = $request['receive'];
                $conversation->save();

                $conversation->users()->save(Auth::user());

                $mes = new Message();
                $mes->message = $request['message'];
                $mes->user_id= Auth::user()->id;
                $mes->conversation_id = Auth::user()->conversations()->where('product_id', $request['product_id'])->get()->first()->id;
                $mes->product_id = $request['product_id'];
                $mes->send = Auth::user()->id;
                $mes->receive = $request['receive'];
                $mes->save();
            }

            /**
             * TODO Add Events
             */
            $user = User::where('id', '=', $mes->receive)->get()->first();

            if($user->can_receive_message_notification())
            {
                Mail::send('email.message_notification', array('user' => $user, 'mes' => $mes), function($mail) use($user){
                    $mail->from('info.sneakbox@gmail.com', 'Sneak.Box info');
                    $mail->to($user->email, $user->name)->subject('У вас новое сообщение');
                });
            }

            return redirect()->back()->with(['message' => 'Сообщение отправленно']);
        }
    }

    public function messagesReceived()
    {
        $conversations = Conversation::select('id', 'subject', 'product_id', 'created_at')->where('receive', Auth::user()->id)->get();
        $conversationInst = new Conversation();
        $messageInst = new Message();

        return view('myprofile.messages-received', ['conversations' => $conversations, 'conversationInst' => $conversationInst, 'messageInst' => $messageInst]);

    }

    public function messagesSend()
    {
        $conversations = Conversation::select('id', 'subject', 'product_id', 'created_at')->where('send', Auth::user()->id)->get();
        $conversationInst = new Conversation();
        $messageInst = new Message();

        return view('myprofile.messages-send', ['conversations' => $conversations, 'conversationInst' => $conversationInst, 'messageInst' => $messageInst]);
    }

    public function showMessage($id)
    {
        $messages = Message::where('conversation_id', $id)->with('user')->get();

        foreach ($messages as $mes)
        {
            $mes->receive == Auth::user()->id ? $mes->read = 1 : '';
            $mes->update();
        }

        return view('message.show', ['messages' => $messages]);
    }

    public function answerMessage(Request $request)
    {
        $conversation = Conversation::find($request['conversation_id']);

        $conversation->read = 0;
        $conversation->update();

        /**
         * определяем получателя письма
         */
        if($conversation->receive == Auth::user()->id)
        {
            $receive = $conversation->send;
        }else{
            $receive = $conversation->receive;
        }

        /* валидация сообшения */
        $rules = ['message' => 'required|max:1000'];
        $messages = ['message.required' => 'Поле обязательное для заполнения',
            'message.max' => 'Максимальное число символов 1000'
        ];

        $this->validate($request, $rules, $messages);

        $mes = new Message();
        $mes->message = $request['message'];
        $mes->user_id= Auth::user()->id;
        $mes->conversation_id =  $request['conversation_id'];
        $mes->product_id = $request['product_id'];
        $mes->send = Auth::user()->id;
        $mes->receive = $receive;
        $mes->save();


        /**
         * TODO Add Events
         */
        $user = User::where('id', '=', $mes->receive)->get()->first();

        if($user->can_receive_message_notification())
        {
            Mail::send('email.message_notification', array('user' => $user, 'mes' => $mes), function($mail) use($user){
                $mail->from('info.sneakbox@gmail.com', 'Sneak.Box info');
                $mail->to($user->email, $user->name)->subject('У вас новое сообщение');
            });
        }

        return redirect()->back()->with(['message' => 'Сообщение отправленно']);
    }

    public function deleteMessages($id)
    {
        $conversation = Conversation::where('id', '=', $id)->get()->first();
        if ($conversation->delete())
            return redirect()->back();
    }
}
