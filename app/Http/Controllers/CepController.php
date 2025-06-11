<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function check(Request $request) {
        $cep = preg_replace('/[^0-9]/', '', $request->cep);
        $data = Http::get("https://viacep.com.br/ws/{$cep}/json/")->json();
        return response()->json($data);
    }

    public function checkCep(Request $request)
    {
        $cep = preg_replace('/[^0-9]/', '', $request->query('cep'));
        \Log::info($cep);
        if (strlen($cep) !== 8) {
            return response()->json(['error' => 'CEP inválido'], 400);
        }

        $response = Http::get("https://viacep.com.br/ws/$cep/json/");

        \Log::debug(json_encode($response));

        if ($response->failed()) {
            return response()->json(['error' => 'Erro ao consultar CEP'], 500);
        }

        return $response->json();
    }

}
