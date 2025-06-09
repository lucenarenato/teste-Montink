<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function check(Request $request) {
        $cep = preg_replace('/[^0-9]/', '', $request->cep);
        $data = Http::get("https://viacep.com.br/ws/{$cep}/json/")->json();
        return response()->json($data);
    }

}
