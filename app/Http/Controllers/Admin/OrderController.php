<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // public function index()
    // {
    //     $orders = Order::orderBy('created_at', 'desc')->paginate(10);
    //     return view('admin.orders.index', ['orders' => $orders]);
    // }


    public function index()
    // FROM orders, order_plate, plates WHERE user_id = 1
    {

        $orders = DB::table("orders")
            ->join('order_plate', 'orders.id', '=', 'order_plate.order_id')
            ->join('plates', 'plates.id', '=', 'order_plate.plate_id')
            ->where('user_id', Auth::user()->id)
            ->get();
        // ->orderBy('created_at', 'desc')
        // ->paginate(10);
        return view('admin.orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $validateData = $request->validate([
            'totalPrice' => 'required|numeric',
            'state_id' => 'required|exists:App\State,id',
        ]);

        $data = $request->all();
        $newOrder = new Order();
        $newOrder->fill($data);
        $newOrder->save();
        return redirect()->route('admin.orders.show', $newOrder->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $data = [
            'order' => $order,
        ];
        return view('admin.orders.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
