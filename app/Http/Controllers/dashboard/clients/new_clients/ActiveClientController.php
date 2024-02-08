<?php

namespace App\Http\Controllers\dashboard\clients\new_clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ActiveClientController extends Controller
{
    public function active(Request $request)
    {
        
        $client = Client::find($request->id);
        if ($client) {
            $client->status = 'active';
            $client->save();
            return response()->json([
                'status'=>true,
                'message'=>'you are the best',
                'id'=>$client->id,
            ]);
        } 
        return response()->json([
            'status'=>true,
            'message'=>'you are the shit'
        ]);
        
    }
    function re_active($id)  {
        $client = Client::find($id);   // Offer::where('id','$offer_id') -> first();

        if (!$client)
            return redirect()->back()->with(['error' => 'error client not found']);

        $client->status = 'active';
        $client->save();
        return redirect()->back()->with(['success' => 'done']);
    }
}
