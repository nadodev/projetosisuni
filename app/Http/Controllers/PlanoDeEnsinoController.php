<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanoDeEnsinoController extends Controller
{
    public function index()
    {
        return view('plano.index');
    }

    public function listar()
    {
        return view('plano.listar');
    }
}
