<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class MtgController extends Controller
{
    public function getCards()
    {
        $response = Http::get('https://mtgjson.com/api/v5/10E.json');

        if ($response->successful()) {
            $data = $response->json();
            \Log::info('Dados recebidos da API:', $data);  // 👈 Log para depuração
            $cards = $data['data']['cards'] ?? [];

            return response()->json($cards);
        }

        \Log::error('Erro ao obter dados da API externa');  // 👈 Log de erro
        return response()->json(['error' => 'Não foi possível obter os dados'], 500);
    }
}
