<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
	 * @param string $title
	 * @param int $id
	 * @return RedirectResponse
	 */
    public function purchaseProduct(Request $request, string $title, int $id) :RedirectResponse{
        $this->marketService->purchaseProduct($id, $request->user()->service_id, 1);
	    return redirect()->route('products.show',[
		    $title,
		    $id
	    ])
		    ->with('success',['Product purchased']);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function showpublishProductForm(Request $request) :Renderable{
        $categories = $this->marketService->getCategories();
        return view('products.publish')->with([
            'categories' => $categories
        ]);
    }

	/**
	 * Show the application dashboard.
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 * @throws ValidationException
	 */
    public function publishProduct(Request $request) :RedirectResponse{
        $rules = [
        	'title' => 'required',
	        'details' => 'required',
	        'stock' => 'required|min:1',
	        'picture' => 'required|image',
	        'category' => 'required'
        ];

        $productData = $this->validate($request,$rules);
        $productData['picture'] = fopen($request->picture->path(), 'r');

        $productData = $this->marketService->publishProduct($request->user()->service_id,$productData);

        $this->marketService->setProductCategory($productData->identifier,$request->category);

        $this->marketService->updateProduct($request->user()->service_id, $productData->identifier, ['situation' => 'available']);

        return redirect()->route('products.show',[
        	$productData->title,
	        $productData->identifier
        ])
	        ->with('success',['Product created successfully']);
    }
}
