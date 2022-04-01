<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
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

        if (
            array_key_exists('orderbycolumn', $data) &&
            array_key_exists('orderbysort', $data)
        ) {
            $users->orderBy($data['orderbycolumn'], $data['orderbysort']);
        }

        if (array_key_exists('categories', $data)) {
            foreach ($data['categories'] as $category) {
                //fa una join per controllare i tag che sono associati al product
                $users->whereHas('categories', function (Builder $query) use ($category) {
                    $query->where('name', '=', $category);
                });
            }
        }

        $users = $users->with(['categories'])->paginate(3);
        return response()->json([
            'response' => true,
            'count' =>  $users->count(),
            'results' => $users
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
