<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artigo;

class ArtigoApiController extends Controller
{
    public function index()
    {
        $artigos = Artigo::with('autor')
            ->where('status', true)
            ->latest()
            ->get()
            ->map(function ($artigo) {

                return [
                    'id' => $artigo->id,

                    'titulo' => $artigo->titulo,

                    'conteudo' => $artigo->conteudo,

                    'imagem' => $artigo->imagem
                    ? url('imagem-artigo/' . $artigo->imagem)
                    : null,

                    'autor' => $artigo->autor
                        ? $artigo->autor->name
                        : null,

                    'data' => $artigo->created_at
                        ->format('d/m/Y'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $artigos
        ]);
    }


    public function show($id)
    {
        $artigo = Artigo::with('autor')
            ->where('status', true)
            ->find($id);

        if (!$artigo) {

            return response()->json([
                'success' => false,
                'message' => 'Artigo não encontrado.'
            ], 404);
        }


        return response()->json([
            'success' => true,

            'data' => [

                'id' => $artigo->id,

                'titulo' => $artigo->titulo,

                'conteudo' => $artigo->conteudo,

                'imagem' => $artigo->imagem
                ? url('imagem-artigo/' . $artigo->imagem)
                : null,

                'autor' => $artigo->autor
                    ? $artigo->autor->name
                    : null,

                'data' => $artigo->created_at
                    ->format('d/m/Y'),
            ]
        ]);
    }
}