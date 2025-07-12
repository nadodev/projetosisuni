<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LegalController extends Controller
{
    /**
     * Exibe a página de Termos de Uso
     */
    public function terms(): View
    {
        return view('legal.terms');
    }

    /**
     * Exibe a página de Política de Privacidade
     */
    public function privacy(): View
    {
        return view('legal.privacy');
    }
} 