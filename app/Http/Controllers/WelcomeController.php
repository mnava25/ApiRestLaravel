<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WelcomeController extends Controller
{
    /**
     * Returns welcome page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showWelcomePage(){
        $products = $this->marketService->getProducts();
        $categories = $this->marketService->getCategories();
        return view('welcome')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
