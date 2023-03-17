<?php

namespace App\Http\Controllers;

use  Illuminate\support\Facades\DB;
use  Illuminate\support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItem = DB::table('cart_items')->distinct()->get();
        return response(collect($cartItem));
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
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',
            'product_id' => 'required',
            'quantity' => 'required|integer|between:1,10'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        };


        $req = $request->all();
        DB::table('cart_items')->insert(
            [
                'cart_id' => $req['cart_id'],
                'quantity' => $req['quantity'],
                'product_id' => $req['product_id'],
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        return response()->json(true);
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
        $req = $request->all();
        DB::table('cart_items')->where('id', $id)->update(
            [
                'quantity' => $req['quantity'],
                'updated_at' => now()
            ]
        );

        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('cart_items')->where('id', $id)->delete();

        return response()->json(true);
    }
}
