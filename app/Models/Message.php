<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function accessMessages($id)
    {
        $conversation = Conversation::find($id);
        if($conversation){
            if (Auth::user()->id == $conversation->receive || Auth::user()->id == $conversation->send) {
                return true;
            }
        }
        return false;
    }

    public function countUnreadMessages($id)
    {
        $messages = Message::select('id')->where('conversation_id', '=', $id)->where('receive', '=', Auth::user()->id)->where('read', '=', 0)->get();
        return count($messages);
    }
}
