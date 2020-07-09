<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param MarketService $marketService
     */
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');
        parent::__construct($marketService);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function showProducts(Request $request) :Renderable{
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function showPurchases(Request $request) :Renderable{
        return view('home');
    }
}
