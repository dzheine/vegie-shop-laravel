<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orders = Order::with('products')->where('user_id', auth()->id())->get();
      //var_dump($orders);
       return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::All();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_amount = 0;
        $order_products = [];
        foreach($request->product as $product){
                array_push($order_products, intval($product));
                $price = Product::where('id', intval($product))->value('price');
                $order_amount  += $price;
        }
        $order = new Order;
        $order->user_id = auth()->id();
        $order->order_amount = $order_amount;
        $order->save();

        $order->products()->sync($order_products);

        $details = [
            'order_id'=>$order->id,
            'order_amount'=> $order_amount
        ];
         Mail::to(auth()->user()->email)->send(new OrderMail($details));
        return redirect()->route('order.index')->with('success', 'Order Created');
        
        // var_dump($order_amount);
        // var_dump($order_products);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $orders = Order::findOrFail($id);

        // return view('order.edit', compact('orders'));
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
        //  $orders = $request->validate([
        //     'name' => 'required|max:255',
        //     'price' => 'required'
        // ]);
        // Order::whereId($id)->update($orders);
        // return redirect()->route('order.index')->with('success', 'Order Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
