<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(9);

        return response()->json([
            'response' => true,
            'count' => $users->count(),
            'results' =>  [
                'data' => $users
            ],
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $users = User::where('id', '>', 0);

        if (array_key_exists('searchedElement', $data))
        {
            $users = $users->where('name', 'like', '%'.$data['searchedElement'].'%');
        }

        if (array_key_exists('orderbysort', $data) && $data['orderbysort'] != null 
            && array_key_exists('orderbycolumn', $data) && $data['orderbycolumn'] != null)
        {
            $users = $users->orderBy($data['orderbycolumn'], $data['orderbysort']);
        }

        $users = $users->paginate(4);

        return response()->json([
            'response' => true,
            'count' =>  $users->count(),
            'results' =>  [
                'data' => $users
            ],
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $user['artists'] = $user->artist()->get();
        $user['writers'] = $user->writer()->get();


        return response()->json([
            'response' => true,
            'count' => $user ? 1 : 0,
            'results' =>  [
                'data' => $user,
            ],
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
