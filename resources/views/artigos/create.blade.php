@extends('layouts.app')

@section('title', 'Novo Artigo')

@section('styles')

<link
    href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css"
    rel="stylesheet"
>

<style>

    .editor-wrapper {
        background: white;
        border-radius: 8px;
    }

    #editor {
        min-height: 400px;
        font-size: 16px;
    }

    .ql-editor {
        min-height: 400px;
    }

    .image-preview {
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
            id="articleForm"
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


            <!-- IMAGEM PRINCIPAL -->

            <div class="mb-4">

                <label class="form-label">
                    Imagem principal
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
                    Conteúdo do artigo
                </label>


                <div class="editor-wrapper">

                    <div id="editor"></div>

                </div>


                <!-- CAMPO QUE SERÁ ENVIADO AO LARAVEL -->

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


function imageHandler() {

    const input = document.createElement('input');

    input.setAttribute('type', 'file');

    input.setAttribute('accept', 'image/*');

    input.click();


    input.onchange = async () => {

        const file = input.files[0];

        if (!file) {
            return;
        }


        const formData = new FormData();

        formData.append('image', file);

        formData.append(
            '_token',
            '{{ csrf_token() }}'
        );


        try {

            const response = await fetch(
                '{{ route('artigos.uploadImage') }}',
                {
                    method: 'POST',
                    body: formData
                }
            );


            const data = await response.json();


            if (!response.ok) {

                alert('Erro ao enviar a imagem.');

                return;
            }


            const range = quill.getSelection(true);


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

            alert('Não foi possível enviar a imagem.');

        }

    };

}


document
    .getElementById('articleForm')
    .addEventListener('submit', function () {

        document
            .getElementById('conteudo')
            .value = quill.root.innerHTML;

    });


document
    .getElementById('imagem')
    .addEventListener('change', function () {

        const preview =
            document.getElementById('preview');

        preview.innerHTML = '';


        const arquivo = this.files[0];

        if (!arquivo) {
            return;
        }


        const imagem =
            document.createElement('img');

        imagem.src =
            URL.createObjectURL(arquivo);

        imagem.classList.add(
            'image-preview'
        );

        preview.appendChild(imagem);

    });

</script>

@endsection