<?php

namespace App\Http\Controllers;

use App;

use Illuminate\Http\Request;

/**
 * Controller for products categories.
 */
class CategoriesController extends Controller
{
    /**
     * Get category by passed alias and show its products
     * 
     * @param string $categoryAlias 
     * @return object Blade template
     */
    public function showCategory($categoryAlias): object
    {
        $products = App\Eloquent\Category
            ::where('alias', $categoryAlias)
            ->with(['products'])
            ->first()
            ->products;

        return view('products', [
            'products' => $products
        ]);
    }
}
