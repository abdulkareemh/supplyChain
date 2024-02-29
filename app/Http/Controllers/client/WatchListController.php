<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class WatchListController extends Controller
{
    function get_list(Request $request) {
        $id =$request->user()->id;
        $list = Client::select('product_list')->where('id',$id)->first();
        return $list;
    }

    function update_list(Request $request) {
        $validated = $request->validate([
            'product_list' => 'sometimes|array',
            'product_list.*' => 'integer|exists:products,id',
        ]);
        $id =$request->user()->id;
        Client::where('id',$id)->update(['product_list'=> $request->product_list]);
        $list = Client::select('product_list')->where('id',$id)->first();
        return $list;
    }

    function getPrices(Request $request) {
        $id =$request->user()->id;
        $prudoctList = Client::where('id',$id)->first()->product_list;
        $list = Product::select('name','price')->whereIn('id',json_decode($prudoctList))->get()->makeVisible(['price']);
        
        return $list;
    }
}
