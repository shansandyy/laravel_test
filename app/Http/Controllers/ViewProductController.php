<?php

namespace App\Http\Controllers;

use  App\Models\Product;
use  App\Models\CartItem;
use  App\Models\User;

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
            "staticE" => $e,
            "staticF" => $f,
        ];
        $rdata = get_object_vars($post);
        return $rdata;
    }

    public function getcartitem()
    {
        $data = CartItem::find(3)->product()->get();
        return response()->json($data);
    }

    public function makeCSV()
    {
        $data = User::all();
        $fileName = 'email_list_' . time() . ".csv";
        $file_open = fopen($fileName, 'a');
        fputcsv($file_open, array('name', 'email'));

        foreach ($data as $dataRow) {
            fputcsv($file_open, array($dataRow->name, $dataRow->email));
        }
        return response()->json($data);

        fclose($file_open);
        $handles = array('Content-Type' => 'text/csv');

        return response()->download($fileName, $fileName, $handles);

        // $data = [
        //     ['year', 'month', 'city'],
        //     ['2020', '10', 'taipei'],
        //     ['2019', '9', 'newyork']
        // ];
        // $file_open = fopen('try.csv', 'w');

        // foreach ($data as $dataRow) {
        //     fputcsv($file_open, $dataRow);
        // }

        // fclose($file_open);
        // $handles = array('Content-Type' => 'text/csv');

        // return response()->download($file_open, $file_open, $handles);
    }
}
