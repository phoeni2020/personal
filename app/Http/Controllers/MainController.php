<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return '/';
    }

    public function test(){
        return 'khaled';
    }
}
