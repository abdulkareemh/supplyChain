<?php

namespace App\Http\Controllers\dashboard\clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class BanClientController extends Controller
{
    public function ban($id)
    {
        $client = Client::find($id);   // Offer::where('id','$offer_id') -> first();

        if (!$client)
            return redirect()->back()->with(['error' => 'error client not found']);

        $client->status = 'ban';
        $client->save();
        return redirect()->back()->with(['success' => 'done']);
    }
}
