<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class MtgController extends Controller
{
    public function getCards(Request $request)
    {
        try {
            $response = Http::timeout(10)->get('https://mtgjson.com/api/v5/10E.json');

            if ($response->successful()) {
                $data = $response->json();
                $cards = collect($data['data']['cards'] ?? []);

                $perPage = 12;
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $currentPageItems = $cards->slice(($currentPage - 1) * $perPage, $perPage)->values();

                $paginatedCards = new LengthAwarePaginator(
                    $currentPageItems,
                    $cards->count(),
                    $perPage,
                    $currentPage,
                    ['path' => $request->url()]
                );

                // // Retorna o JSON com os dados paginados
                // return response()->json($paginatedCards);
                // ---------------------------------------------------
                // Agora retorna a view em vez do JSON
                return view('cards.index', ['cards' => $paginatedCards]);
            }

            return response()->json(['error' => 'Erro na API externa'], 502);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha na conexão com a API'], 500);
        }
    }
}