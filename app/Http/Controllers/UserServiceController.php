<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Services\ShortUrlService;


class UserServiceController extends Controller
{
    public function index(Request $Request, ShortUrlService $shortUrlService)
    {
        return $shortUrlService->upadateProduct($Request->input());
    }
}
