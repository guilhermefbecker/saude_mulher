@extends('layouts.app')

@section('title', 'Novo Artigo')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title">
            Novo artigo
        </h1>

        <p class="page-subtitle">
            Cadastre um novo artigo para o aplicativo.
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
            action="{{ route('artigos.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <!-- TÍTULO -->

            <div class="mb-4">

                <label class="form-label">

                    Título do artigo

                </label>

                <input
                    type="text"
                    name="titulo"
                    class="form-control"
                    placeholder="Digite o título do artigo"
                    value="{{ old('titulo') }}"
                    required
                >

            </div>


            <!-- IMAGEM -->

            <div class="mb-4">

                <label class="form-label">

                    Imagem

                </label>

                <input
                    type="file"
                    name="imagem"
                    id="imagem"
                    class="form-control"
                    accept="image/png,image/jpeg,image/webp"
                >

                <small class="text-muted">

                    JPG, PNG ou WEBP. Máximo 2 MB.

                </small>


                <div id="preview"></div>

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
                    placeholder="Digite o conteúdo do artigo..."
                    required
                >{{ old('conteudo') }}</textarea>

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
                        checked
                    >

                    <label
                        class="form-check-label"
                        for="status"
                    >

                        Publicar artigo

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

                    Salvar artigo

                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@section('scripts')

<script>

document
    .getElementById('imagem')
    .addEventListener('change', function () {

        const preview = document.getElementById('preview');

        preview.innerHTML = '';

        const arquivo = this.files[0];

        if (!arquivo) {
            return;
        }


        const imagem = document.createElement('img');

        imagem.src = URL.createObjectURL(arquivo);

        imagem.classList.add('image-preview');

        preview.appendChild(imagem);

    });

</script>

@endsection