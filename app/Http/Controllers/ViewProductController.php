<?php

namespace App\Http\Controllers;

use  App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\View\View;
use SoapClient;

class ViewProductController extends Controller
{
    public function __invoke()
    {
        $products = Product::all();
        return view('web.wel', ['products' => $products]);
    }

    // public function index()
    // {
    //     $products = Product::all();
    //     return view('web.wel', ['products' => $products]);
    // }

    protected $domain;

    public function __construct()
    {
        $this->domain = 'family';
    }

    public function testtest()
    {
        $domainName = $this->domain;
        // $soap = new SoapClient($domainName);
        return response()->json($domainName);
    }

    public function getObjectVars()
    {
        static $e;
        static $f;

        $post = (object)[
            "storeName" => "SUNNYGO",
            "cardNo" => "",
            "idNo" => "abcd",
            "cardBirthday" => 4567,
            "tel" => "",
            "value" => "",
            "staticE"=> $e,
            "staticF"=> $f,
        ];
        $rdata = get_object_vars($post);
        return $rdata;
    }
}
