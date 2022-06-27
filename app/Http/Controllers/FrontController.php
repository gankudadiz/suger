<?php
namespace App\Http\Controllers;

class FrontController extends Controller{
    public function index(){
        echo 123;
        return view('welcome');
    }
}
