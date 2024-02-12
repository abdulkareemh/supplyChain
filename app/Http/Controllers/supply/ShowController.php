<?php

namespace App\Http\Controllers\supply;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    function index()
    {
        $suppliers = Supplier::get();
        return $suppliers;
    }

    function supplyIndex($id)
    {
        $supplier = Supplier::where('id', $id)
            ->with(['products' => function ($query) {
                $query->with(['prices' => function ($query) {
                    $query->orderBy('created_at', 'asc');
                }, 'images']);
            }])
            ->first();

        // Adding the first price to each product
        $supplier->products->each(function ($product) {
            $product->p_price = $product->prices->first()->price ?? null;
            $product->makeHidden('prices');
        });
        return $supplier;
    }
}
