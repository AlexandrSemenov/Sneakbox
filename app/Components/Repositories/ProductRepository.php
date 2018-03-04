<?php

namespace App\Components\Repositories;

use App\Models\Product;

class ProductRepository
{

    /**
     * return Query of all Products
     */
    private static function getAllProductsQuery()
    {
        return Product::where([
            ['active', '=', 1],
        ])->orderBy('updated_at', 'desc');
    }

    public function getAll()
    {
        return self::getAllProductsQuery()->get();
    }

    /**
     * return Collection of last eight Product type object
     */
    public function lastItems()
    {
        return self::getAllProductsQuery()->take(8)->get();
    }
}