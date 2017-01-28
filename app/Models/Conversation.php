<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Conversation extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'conversations_users');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Messages');
    }

    public function getImage($id)
    {
        $prodImage = Product::select('image')->where('id', $id)->first();
        return $prodImage->image;
    }
}
