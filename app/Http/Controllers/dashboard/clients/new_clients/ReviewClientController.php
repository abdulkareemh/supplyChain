<?php

namespace App\Http\Controllers\dashboard\clients\new_clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ReviewClientController extends Controller
{
  public function index()
  {
    $clients = Client::where('status','pending')->get();
    
    return view('content.dashboard.client.review_client.index',['clients'=>$clients]);
  }
}
