<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Returns welcome page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProduct($title, $id){
        $products = $this->marketService->getCategoryProducts($id);
        return view('categories.products.show')->with([
            'products' => $products,
        ]);
    }
}
