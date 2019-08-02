<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Client $client)
    {
        $categories = Category::all();
        return view('dashboard.clients.orders.create',compact('categories' ,'client'));
    }

    public function store(Request $request, Client $client)
    {
        //
    }

    public function edit(Client $client, Order $order)
    {
        //
    }


    public function update(Request $request, Client $client, Order $order)
    {
        //
    }

    public function destroy(Client $client, Order $order)
    {
        //
    }
}
