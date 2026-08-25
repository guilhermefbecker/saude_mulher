<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtigoController extends Controller
{
    public function index()
{
    $artigos = Artigo::with('autor')
        ->latest()
        ->get();

    return view('artigos.index', compact('artigos'));
}

public function uploadImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
    ]);

    $path = $request
        ->file('image')
        ->store('artigos/conteudo', 'public');

    return response()->json([
        'url' => asset('storage/' . $path)
    ]);
}


    public function create()
    {
        return view('artigos.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $artigo = new Artigo();

        $artigo->titulo = $request->titulo;
        $artigo->conteudo = $request->conteudo;
        $artigo->status = $request->has('status');
        $artigo->user_id = auth()->id();

        if ($request->hasFile('imagem')) {
            $artigo->imagem = $request
                ->file('imagem')
                ->store('artigos', 'public');
        }

        $artigo->save();

        return redirect()
            ->route('artigos.index')
            ->with('success', 'Artigo cadastrado com sucesso!');
    }


    public function edit(Artigo $artigo)
    {
        return view('artigos.edit', compact('artigo'));
    }


    public function update(Request $request, Artigo $artigo)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $artigo->titulo = $request->titulo;
        $artigo->conteudo = $request->conteudo;
        $artigo->status = $request->has('status');

        if ($request->hasFile('imagem')) {

            if ($artigo->imagem) {
                Storage::disk('public')->delete($artigo->imagem);
            }

            $artigo->imagem = $request
                ->file('imagem')
                ->store('artigos', 'public');
        }

        $artigo->save();

        return redirect()
            ->route('artigos.index')
            ->with('success', 'Artigo atualizado com sucesso!');
    }


    public function destroy(Artigo $artigo)
    {
        if ($artigo->imagem) {
            Storage::disk('public')->delete($artigo->imagem);
        }

        $artigo->delete();

        return redirect()
            ->route('artigos.index')
            ->with('success', 'Artigo excluído com sucesso!');
    }
}