<?php

namespace App\Http\Controllers;

use Attribute;
use  Illuminate\support\Facades\DB;
use  Illuminate\support\Facades\Validator;
use  Illuminate\Http\Request;
use  Illuminate\Support\Collection;

use  App\Http\Requests\UpdateCartItem;
use  App\Models\Cart;
use  App\Models\CartItem;
use  App\Models\Product;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cartItem = DB::table('cart_items')->distinct()->get();
        $cartItem = Product::find(2)->cartItems()->get();

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
        $message = [
            'required' => ':attribute 必填欄位',
            'between' => ':attribute 輸入的 :input 不在 :min ~ :max 之間',
        ];
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',
            'product_id' => 'required',
            'quantity' => 'required|integer|between:1,50'
        ], $message);

        // $validator->fails() 會顯示 true / false
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        };

        $validateData = $validator->validate();
        // dd($validateData);

        $req = $request->all();

        // $cart = Cart::find($validateData['cart_id']);
        // $result = $cart->cartItems()->create([
        //         'quantity' => $validateData['quantity'],
        //         'product_id' => $validateData['product_id']
        //     ]);

        CartItem::insert(
            [
                'cart_id' => $validateData['cart_id'],
                'quantity' => $validateData['quantity'],
                'product_id' => $validateData['product_id'],
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        return response()->json('ok');
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
    public function update(UpdateCartItem $request, $id)
    {
        $req = $request->validate();
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
        // DB::table('cart_items')->where('id', $id)->delete();
        
        CartItem::withTrashed()->find($id)->forceDelete();

        return response()->json(true);
    }
}
