<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function postLogin(Request $request){
        // $account = $request -> input('account');
        $account = $request -> path();
        // return response($account);

        // 判斷請求路徑是否與給定的模式相符合
        // if ($request -> is('login')) {
        //     return response('your '.$account);
        // }else{
        //     return response($account);
        // };

        $url = $request->url();
        return response($url);  // http://127.0.0.1:8000/login

    }

}