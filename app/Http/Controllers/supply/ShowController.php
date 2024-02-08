<?php

namespace App\Http\Controllers\supply;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    
    function index() {
        $suppliers = Supplier::get();
        return $suppliers;
    }

    function supplyIndex($id) {
        $supplier = Supplier::where('id',$id)->with('products')->get();
        return $supplier;
    }
}
