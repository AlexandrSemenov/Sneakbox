<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\DB;

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

                $message = new Message();
                $message->message = $request['message'];
                $message->user_id= Auth::user()->id;
                $message->conversation_id =  Auth::user()->conversations()->where('product_id', $request['product_id'])->get()->first()->id;
                $message->product_id = $request['product_id'];
                $message->send = Auth::user()->id;
                $message->receive = $request['receive'];
                $message->save();
            }else{
                $conversation = new Conversation();
                $conversation->subject = $request['subject'];
                $conversation->product_id = $request['product_id'];
                $conversation->user_id = Auth::user()->id;
                $conversation->send = Auth::user()->id;
                $conversation->receive = $request['receive'];
                $conversation->save();

                $conversation->users()->save(Auth::user());

                $message = new Message();
                $message->message = $request['message'];
                $message->user_id= Auth::user()->id;
                $message->conversation_id = Auth::user()->conversations()->where('product_id', $request['product_id'])->get()->first()->id;
                $message->product_id = $request['product_id'];
                $message->send = Auth::user()->id;
                $message->receive = $request['receive'];
                $message->save();

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

        foreach ($messages as $message)
        {
            $message->receive == Auth::user()->id ? $message->read = 1 : '';
            $message->update();
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

        $message = new Message();
        $message->message = $request['message'];
        $message->user_id= Auth::user()->id;
        $message->conversation_id =  $request['conversation_id'];
        $message->product_id = $request['product_id'];
        $message->send = Auth::user()->id;
        $message->receive = $receive;
        $message->save();

        return redirect()->back()->with(['message' => 'Сообщение отправленно']);
    }
}
