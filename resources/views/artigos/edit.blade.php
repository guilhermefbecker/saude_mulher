@extends('layouts.app')

@section('title', 'Editar Artigo')

@section('styles')

<link
    href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css"
    rel="stylesheet"
>

<style>

    #editor {
        min-height: 400px;
        font-size: 16px;
    }

    .ql-editor {
        min-height: 400px;
    }

    .current-image {
        max-width: 300px;
        max-height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-top: 10px;
    }

</style>

@endsection


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
            id="articleForm"
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


            <!-- IMAGEM PRINCIPAL -->

            @if($artigo->imagem)

                <div class="mb-4">

                    <label class="form-label">
                        Imagem atual
                    </label>

                    <br>

                    <img
                        src="{{ asset('storage/' . $artigo->imagem) }}"
                        class="current-image"
                    >

                </div>

            @endif


            <div class="mb-4">

                <label class="form-label">
                    Alterar imagem principal
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


            <!-- EDITOR -->

            <div class="mb-4">

                <label class="form-label">
                    Conteúdo do artigo
                </label>


                <div>

                    <div id="editor"></div>

                </div>


                <input
                    type="hidden"
                    name="conteudo"
                    id="conteudo"
                >

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


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>


<script>

const toolbarOptions = [

    [
        {
            'header': [1, 2, 3, 4, 5, 6, false]
        }
    ],

    [
        'bold',
        'italic',
        'underline',
        'strike'
    ],

    [
        {
            'list': 'ordered'
        },
        {
            'list': 'bullet'
        }
    ],

    [
        {
            'align': []
        }
    ],

    [
        'blockquote',
        'link',
        'image'
    ],

    [
        'clean'
    ]

];


const quill = new Quill('#editor', {

    theme: 'snow',

    placeholder: 'Digite o conteúdo do artigo...',

    modules: {

        toolbar: {

            container: toolbarOptions,

            handlers: {

                image: imageHandler

            }

        }

    }

});


/*
|--------------------------------------------------------------------------
| CARREGAR CONTEÚDO EXISTENTE
|--------------------------------------------------------------------------
*/

const conteudoExistente =
    @json($artigo->conteudo ?? '');


if (conteudoExistente) {

    quill.clipboard.dangerouslyPasteHTML(
        conteudoExistente
    );

}


/*
|--------------------------------------------------------------------------
| INSERIR IMAGEM
|--------------------------------------------------------------------------
*/

function imageHandler() {

    const input =
        document.createElement('input');

    input.setAttribute(
        'type',
        'file'
    );

    input.setAttribute(
        'accept',
        'image/*'
    );

    input.click();


    input.onchange = async () => {

        const file =
            input.files[0];

        if (!file) {
            return;
        }


        const formData =
            new FormData();

        formData.append(
            'image',
            file
        );

        formData.append(
            '_token',
            '{{ csrf_token() }}'
        );


        try {

            const response =
                await fetch(
                    '{{ route('artigos.uploadImage') }}',
                    {
                        method: 'POST',
                        body: formData
                    }
                );


            const data =
                await response.json();


            if (!response.ok) {

                alert(
                    'Erro ao enviar a imagem.'
                );

                return;
            }


            const range =
                quill.getSelection(true);


            quill.insertEmbed(
                range.index,
                'image',
                data.url
            );


            quill.setSelection(
                range.index + 1
            );


        } catch (error) {

            console.error(error);

            alert(
                'Não foi possível enviar a imagem.'
            );

        }

    };

}


/*
|--------------------------------------------------------------------------
| ANTES DE SALVAR
|--------------------------------------------------------------------------
*/

document
    .getElementById('articleForm')
    .addEventListener(
        'submit',
        function () {

            document
                .getElementById('conteudo')
                .value =
                quill.root.innerHTML;

        }
    );

</script>

@endsection