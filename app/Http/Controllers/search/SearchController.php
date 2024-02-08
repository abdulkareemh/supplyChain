<?php

namespace App\Http\Controllers\search;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function suppliersSearch(Request $request)
    {
        $query = $request->input('search_query');
        $Suppliers = Supplier::where('name', 'like', '%' . $query . '%')->get();
        return view('Suppliers.search_results', ['Suppliers' => $Suppliers]);
    }

    function prudoctSearch(Request $request)
    {
        $query = $request->input('search_query');
        $products = Product::where('name', 'like', '%' . $query . '%')->get();
        return view('products.search_results', ['products' => $products]);
    }
}
