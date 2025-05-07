<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return "welcome to the homepage";
    }
    public function randomUser(){
        return view('generarRandomUser');
    }
}
