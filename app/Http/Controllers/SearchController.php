<?php

namespace App\Http\Controllers;

use App;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Get searchstring from request and find products by
     * title or description. Then returns template.
     * 
     * @param \Illuminate\Http\Request $Request 
     * @return object Blade template
     */
    public function search(Request $Request): object 
    {
        $searchstring = $Request->query('searchstring', null);

        $products = $this->getProductsBy($searchstring);
        
        return view('search', [
            'products' => $products,
            'searchstring' => $searchstring,
        ]);
    }

    /**
     * Get all products by passed searchstring.
     * Without any pagination for this time.
     * 
     * @param string $searchstring 
     * @return iterable
     */
    private function getProductsBy(string $searchstring): iterable {
        $products = [];

        if($searchstring) {
            $products = App\Eloquent\Products::with(['categories'])
                ->where('title', 'like', '%' . $searchstring . '%')
                ->orWhere('description', 'like', '%' . $searchstring . '%')
                ->get();
        }

        return $products;
    }
}
