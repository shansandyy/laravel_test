<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{
    public function getHome(){
    return 'bbb';
    }

    public function homePage(){
    return 'ccc';
    }
}