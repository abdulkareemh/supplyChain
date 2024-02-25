<?php

namespace App\Http\Controllers\supply;

use App\Http\Controllers\Controller;
use App\Models\ServiceArea;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ServiceLocatinoController extends Controller
{
    function index(Request $request)
    {

        try {
            $id = $request->user()->id;
            $location = ServiceArea::where('supply_id', $id)->first();
            return $location->name;
        } catch (Exception $e) {
            return 'non';
        }
    }
    function createOrUpdate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                
            ]);
            
            $id = $request->user()->id;
            $newServiceArea = ServiceArea::updateOrCreate(
                ['supply_id' => $id],
                ['name' => $request->name]
            );
            return response('done',200);
        } catch (Exception $e) {
            return $e;
        }
    }
}
