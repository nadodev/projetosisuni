<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanoDeEnsinoController extends Controller
{
    public function index()
    {
        return view('plano.index');
    }
}
