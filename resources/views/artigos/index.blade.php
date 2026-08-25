@extends('layouts.app')

@section('title', 'Artigos')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title">
            Artigos
        </h1>

        <p class="page-subtitle">
            Gerencie os artigos disponíveis no aplicativo.
        </p>

    </div>


    <a
        href="{{ route('artigos.create') }}"
        class="btn btn-primary"
    >

        <i class="bi bi-plus-lg"></i>

        Novo artigo

    </a>

</div>


{{-- MENSAGEM DE SUCESSO --}}

@if(session('success'))

    <div class="alert alert-success">

        <i class="bi bi-check-circle"></i>

        {{ session('success') }}

    </div>

@endif


{{-- MENSAGEM DE ERRO --}}

@if(session('error'))

    <div class="alert alert-danger">

        <i class="bi bi-exclamation-circle"></i>

        {{ session('error') }}

    </div>

@endif


{{-- ERROS DE VALIDAÇÃO --}}

@if($errors->any())

    <div class="alert alert-danger">

        <strong>
            Verifique os seguintes erros:
        </strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $erro)

                <li>
                    {{ $erro }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


{{-- LISTA DE ARTIGOS --}}

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-newspaper"></i>

            Artigos cadastrados

        </h5>


        <span class="badge bg-secondary">

            {{ $artigos->count() }}

            {{ $artigos->count() == 1 ? 'artigo' : 'artigos' }}

        </span>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th style="width: 70px;">
                            ID
                        </th>

                        <th style="width: 100px;">
                            Imagem
                        </th>

                        <th>
                            Título
                        </th>

                        <th>
                            Autor
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Data
                        </th>

                        <th class="text-end">
                            Ações
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($artigos as $artigo)

                        <tr>

                            {{-- ID --}}

                            <td>

                                <span class="text-muted">

                                    #{{ $artigo->id }}

                                </span>

                            </td>


                            {{-- IMAGEM --}}

                            <td>

                                @if($artigo->imagem)

                                    <img
                                        src="{{ asset('storage/' . $artigo->imagem) }}"
                                        alt="{{ $artigo->titulo }}"
                                        style="
                                            width: 70px;
                                            height: 50px;
                                            object-fit: cover;
                                            border-radius: 8px;
                                        "
                                    >

                                @else

                                    <div
                                        style="
                                            width: 70px;
                                            height: 50px;
                                            border-radius: 8px;
                                            background: #f1f1f1;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                        "
                                    >

                                        <i class="bi bi-image text-muted"></i>

                                    </div>

                                @endif

                            </td>


                            {{-- TÍTULO --}}

                            <td>

                                <strong>

                                    {{ $artigo->titulo }}

                                </strong>


                                <div class="text-muted small">

                                    {{ Str::limit(
                                        strip_tags($artigo->conteudo),
                                        80
                                    ) }}

                                </div>

                            </td>


                            {{-- AUTOR --}}

                            <td>

                                @if($artigo->autor)

                                    <div class="d-flex align-items-center">

                                        <i
                                            class="bi bi-person-circle me-2"
                                            style="font-size: 22px;"
                                        ></i>

                                        <span>

                                            {{ $artigo->autor->name }}

                                        </span>

                                    </div>

                                @else

                                    <span class="text-muted">

                                        Não informado

                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @if($artigo->status)

                                    <span class="badge bg-success">

                                        <i class="bi bi-check-circle"></i>

                                        Publicado

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        <i class="bi bi-file-earmark"></i>

                                        Rascunho

                                    </span>

                                @endif

                            </td>


                            {{-- DATA --}}

                            <td>

                                <div>

                                    {{ $artigo->created_at->format('d/m/Y') }}

                                </div>

                                <small class="text-muted">

                                    {{ $artigo->created_at->format('H:i') }}

                                </small>

                            </td>


                            {{-- AÇÕES --}}

                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-1">

                                    {{-- EDITAR --}}

                                    <a
                                        href="{{ route(
                                            'artigos.edit',
                                            $artigo->id
                                        ) }}"
                                        class="btn btn-sm btn-warning"
                                        title="Editar artigo"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- EXCLUIR --}}

                                    <form
                                        action="{{ route(
                                            'artigos.destroy',
                                            $artigo->id
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm(
                                            'Deseja realmente excluir este artigo?'
                                        )"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Excluir artigo"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5"
                            >

                                <div class="mb-3">

                                    <i
                                        class="bi bi-newspaper"
                                        style="font-size: 45px;"
                                    ></i>

                                </div>


                                <h5>
                                    Nenhum artigo cadastrado
                                </h5>


                                <p class="text-muted">

                                    Comece criando seu primeiro artigo.

                                </p>


                                <a
                                    href="{{ route('artigos.create') }}"
                                    class="btn btn-primary"
                                >

                                    <i class="bi bi-plus-lg"></i>

                                    Criar primeiro artigo

                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection