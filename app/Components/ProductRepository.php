<?php

namespace App\Components;

use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function getPriceRange()
    {
         $range = DB::table('products')->select(DB::raw('min(price) as min, max(price) as max'))->get();
         return $range = $range[0];
    }
}