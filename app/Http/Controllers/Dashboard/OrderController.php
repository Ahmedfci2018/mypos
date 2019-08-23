<?php

namespace App\Http\Controllers\Dashboard;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($query) use ($request){

            $query->where('name', 'like', '%'. $request->search. '%');

        })->paginate(5);

        return view('dashboard.orders.index',compact('orders'));

    } //end of index

    public function products(Order $order){

        $products = $order->products;
        return view('dashboard.orders._products',compact('order', 'products'));

    }
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
        //
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy(Order $order)
    {
        foreach ($order->products as $product) {

            $product->update([

                'stock'=> $product->stock + $product->pivot->quantity,
            ]);
        }
        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');
    }
}
