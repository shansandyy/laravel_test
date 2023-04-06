<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function store(Request $request)
    {
        // $postData = $request->all();
        // return response()->json($postData);
        return 'aaaaaa';
    }
}
