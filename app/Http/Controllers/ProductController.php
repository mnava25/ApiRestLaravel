<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param MarketService $marketService
     */
    public function __construct(MarketService $marketService) {
        $this->middleware('auth')->except(['showProduct']);
        parent::__construct($marketService);
    }
    /**
     * Returns welcome page
     * @return Factory|View
     */
    public function showProduct($title,$id){
        $product = $this->marketService->getProduct($id);

        return view('products.show')->with([
            'product' => $product,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function purchaseProduct(Request $request) :Renderable{
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function showpublishProductForm(Request $request) :Renderable{
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function publishProduct(Request $request) :Renderable{
        return view('home');
    }
}
