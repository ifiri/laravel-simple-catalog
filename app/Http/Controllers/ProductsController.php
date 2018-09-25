<?php

namespace App\Http\Controllers;

use App;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private const POPULAR_PRODUCTS_COUNT = 20;

    /**
     * Show last N popular products. Popularity is a 
     * sum of all offer's sales
     * 
     * @return object Blade template
     */
    public function showMostPopular(): object
    {
        $products = App\Eloquent\Products
            ::with(['offers', 'categories'])
            ->popular()
            ->take(
                $this::POPULAR_PRODUCTS_COUNT
            )
            ->get();

        return view('products', [
            'products' => $products
        ]);
    }
}
