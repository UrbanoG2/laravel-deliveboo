<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Guest;
use App\Order;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // $validateData = $request->validate([
        //     'fisrtname'=> 'required',
        //     'lastname'=> 'required',
        //     'address'=> 'required',
        //     'email'=> 'required|email',
        //     'phoneNumber'=> 'required',
        // ]);


        $data = $request->all();

        $dataOrder = $data['infoCart'];
        $newOrder = new Order();
        $newOrder->fill($dataOrder);
        $newOrder->state_id = 1; //da sistemare 
        $newOrder->save();

        $newOrder->plates()->sync($dataOrder['categories'], ['child' => $childid]);

        $dataGuest = $data['guest'];
        $newGuest = new Guest();
        $newGuest->fill($dataGuest);
        $newGuest->order_id = 3; //da sistemare 
        $newGuest->save();
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
