<?php

namespace App\Components;

class QueryParams
{
    public function getParams()
    {
        $queryParams = [];
        if(!empty($_GET['category']))
        {
            $queryParams['category'] = $_GET['category'];
        }
        if(!empty($_GET['size']))
        {
            $queryParams['size'] = $_GET['size'];
        }
        if(!empty($_GET['condition']))
        {
            $queryParams['condition'] = $_GET['condition'];
        }
        if(!empty($_GET['price_from']) || !empty($_GET['price_till']))
        {
            $queryParams['price_from'] = $_GET['price_from'];
            $queryParams['price_till'] = $_GET['price_till'];
        }

        if (!empty($_GET['search']))
        {
            $queryParams['search'] = $_GET['search'];
        }
        return $queryParams;
    }
}