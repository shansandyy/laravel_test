<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHome()
    {
        return 'bbb';
    }

    public function homePage(Request $Request)
    {
        $data = $Request->all();

        if ($data['status'] === "001") {
            $data['status'] = "1";
        }

        if ($data['status'] === "002") {
            $data['status'] = "2";
        }

        $postData = [
            "type" => $data['status'],
            "ticket_num" => $data['couponNo'],
            "verify_date" => $data['posDate']
        ];
        return $postData;
    }
}
