<?php

namespace App\Http\Controllers\supply;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->user()->id;
        $products = Product::where('supply_id', $id)->all();
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'nullable|integer',
            'p_price' => 'required',
            'images' => 'nullable|array', // if multiple images
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validation for each image
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'price' => $request->price,
        ]);
        Price::created([
            'prise' => $request->p_price,
            'product_id' => $product->id,
        ]);
        // Handle image upload
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/storage/products'); // storing images in 'public/images'
                Images::create([
                    'product_id' => $product->id,
                    'image_url' => $path
                ]);
            }
        }

        return response()->json(['message' => 'Product created successfully.', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->with('images')->first();
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the product
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        


        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'quantity' => 'sometimes|required|integer',
            'category_id' => 'sometimes|required|exists:categories,id',
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'price' => 'sometimes|required|integer',
            'p_price' => 'sometimes',
            'images' => 'sometimes|array', // if multiple images
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validation for each image
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $price = Price::where('product_id', $product->id)->first();
        if ($request->hasfile('p_price')) {
            $price->update($request->only(['p_price']));
            
        }
        // Update the product
        $product->update($request->only(['name', 'description', 'quantity', 'category_id', 'supplier_id', 'price']));


        // Handle image uploads
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images'); // storing images in 'public/images'
                Images::create([
                    'product_id' => $product->id,
                    'image_url' => $path
                ]);
            }
        }

        return response()->json(['message' => 'Product updated successfully.', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the product
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Delete associated images if necessary
        // Assuming each product has one or more images associated with it
        // foreach ($product->images as $image) {
        //     // Delete the image file if you store images in your server
        //     // Storage::delete($image->image_url);

        //     // Delete the image record
        //     $image->delete();
        // }

        // Delete the product
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
