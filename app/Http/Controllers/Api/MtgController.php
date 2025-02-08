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
            $cards = $data['data']['cards'] ?? [];  // Verifique se a API retorna 'cards'

            return response()->json($cards);
        }

        return response()->json(['error' => 'Não foi possível obter os dados'], 500);
    }
}

