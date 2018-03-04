<?php

namespace App\Http\Controllers;

use App\Components\Repositories\ProductRepository;

class MainController extends Controller
{
    public function index(ProductRepository $productRepository)
    {
        $lastItems = $productRepository->lastItems();
        return view('main.index', ['lastItems' => $lastItems]);
    }
}