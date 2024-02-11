<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with(['prices' => function ($query) {
                $query->orderBy('created_at', 'asc'); // or any other order you prefer
            }])->with('images')->paginate(10);

            // Adding the first price to each product
            $products->each(function ($product) {
                $product->p_price = $product->prices->first()->price ?? null;
                $product->makeHidden('prices');
            });

            return $products;
        } catch (Exception $e) {
            return response('try next time', 300);
        }
    }

    function productIndex($id)
    {
        try {
            $product = Product::where('id', $id)->with('prices', 'images')->firstOrFail();
            $transformedProduct = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'quantity' => $product->quantity,
                'category_id' => $product->category_id,
                'supplier_id' => $product->supplier_id,
                'p_price' => $product->prices->sortBy('created_at')->first()->price ?? null,
                'price' => $product->price,
                'images' => $product->images->map(function($image) {
                    return [
                        'url' => $image->image_url,
                        'product_id'=>$image->product_id,
                        // include any other image attributes you need
                    ];
                })->toArray(),
                // include any other attributes you want to return
            ];
            return $transformedProduct;
        } catch (Exception $e) {
            return response('try next time', 300);
        }
    }
}
