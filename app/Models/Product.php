<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function condition()
    {
        return $this->belongsTo('App\Models\Condition');
    }

    public function size()
    {
        return $this->belongsTo('App\Models\Size');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function conversations()
    {
        return $this->hasMany('App\Models\Conversation');
    }

    public function productFilter()
    {
        $query = Product::where('active', 1);
        if(!empty($_GET['category']))
        {
            $query->whereIn('category_id', $_GET['category']);
        }
        if(!empty($_GET['size']))
        {
            $query->whereIn('size_id', $_GET['size']);
        }
        if(!empty($_GET['condition']))
        {
            $query->whereIn('condition_id', $_GET['condition']);
        }
        if(!empty($_GET['price_from']) || !empty($_GET['price_till']))
        {
            $query->whereBetween('price', array($_GET['price_from'], $_GET['price_till']));
        }

        return count($query->get()) > 0 ? $query->orderBy('updated_at', 'desc')->paginate(16) : "Совпадений не найдено";
    }
}
