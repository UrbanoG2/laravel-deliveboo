<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plate;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $orders = DB::table("orders")
                    ->select('orders.id', 'orders.totalPrice', 'orders.created_at', 'orders.updated_at')
                    ->distinct()
                    ->join('order_plate', 'orders.id', '=', 'order_plate.order_id')
                    ->join('plates', 'plates.id', '=', 'order_plate.plate_id')
                    ->where('user_id', Auth::user()->id)
                    ->limit(5)
                    ->get();
        $mostPlates = DB::table("orders")
                    ->selectRaw('plate_id, plates.name, SUM(quantity) as Tot')
                    ->join('order_plate', 'orders.id', '=', 'order_plate.order_id')
                    ->join('plates', 'plates.id', '=', 'order_plate.plate_id')
                    ->where('user_id', Auth::user()->id)
                    ->groupBy('plate_id')
                    ->orderBy('Tot', 'desc')
                    ->limit(5)
                    ->get();
        $plates = Plate::where('user_id', $id)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('admin.home', ['plates' => $plates, 'orders'=> $orders, 'populars' => $mostPlates]);

    }
}

