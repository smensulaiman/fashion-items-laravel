<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index(): string
    {
        return csrf_token();
    }

    public function chamari(): string
    {
        return "hello cha mari";
    }
}
