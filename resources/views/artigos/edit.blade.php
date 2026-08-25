@extends('layouts.app')

@section('title', 'Editar Artigo')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title">
            Editar artigo
        </h1>

        <p class="page-subtitle">
            Altere as informações do artigo.
        </p>

    </div>


    <a
        href="{{ route('artigos.index') }}"
        class="btn btn-secondary"
    >

        <i class="bi bi-arrow-left"></i>

        Voltar

    </a>

</div>


<div class="card">

    <div class="card-body p-4">

        <form
            action="{{ route('artigos.update', $artigo->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            <!-- TÍTULO -->

            <div class="mb-4">

                <label class="form-label">

                    Título do artigo

                </label>

                <input
                    type="text"
                    name="titulo"
                    class="form-control"
                    value="{{ old('titulo', $artigo->titulo) }}"
                    required
                >

            </div>


            <!-- IMAGEM ATUAL -->

            @if($artigo->imagem)

                <div class="mb-4">

                    <label class="form-label">

                        Imagem atual

                    </label>

                    <br>

                    <img
                        src="{{ asset('storage/' . $artigo->imagem) }}"
                        class="image-preview"
                        alt="Imagem atual"
                    >

                </div>

            @endif


            <!-- NOVA IMAGEM -->

            <div class="mb-4">

                <label class="form-label">

                    Alterar imagem

                </label>

                <input
                    type="file"
                    name="imagem"
                    class="form-control"
                    accept="image/png,image/jpeg,image/webp"
                >

                <small class="text-muted">

                    Deixe vazio para manter a imagem atual.

                </small>

            </div>


            <!-- CONTEÚDO -->

            <div class="mb-4">

                <label class="form-label">

                    Conteúdo

                </label>

                <textarea
                    name="conteudo"
                    class="form-control"
                    rows="12"
                    required
                >{{ old('conteudo', $artigo->conteudo) }}</textarea>

            </div>


            <!-- STATUS -->

            <div class="mb-4">

                <div class="form-check form-switch">

                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        class="form-check-input"
                        id="status"

                        {{ old('status', $artigo->status) ? 'checked' : '' }}
                    >

                    <label
                        class="form-check-label"
                        for="status"
                    >

                        Artigo ativo

                    </label>

                </div>

            </div>


            <hr>


            <!-- BOTÕES -->

            <div class="d-flex justify-content-end gap-2 mt-4">

                <a
                    href="{{ route('artigos.index') }}"
                    class="btn btn-secondary"
                >

                    Cancelar

                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-check-lg"></i>

                    Salvar alterações

                </button>

            </div>

        </form>

    </div>

</div>

@endsection