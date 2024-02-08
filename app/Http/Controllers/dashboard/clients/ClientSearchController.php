<?php

namespace App\Http\Controllers\dashboard\clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientSearchController extends Controller
{
  public function search(Request $request)
  {
    $keyword = $request->input('keyword');
        // Query to fetch clients with optional search
        $clients = Client::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%')
                ->orWhere('city', 'like', '%' . $keyword . '%');
        })->simplepaginate(2); // Adjust the pagination as needed

        
        return  $clients->render();
    

        
  }
}
