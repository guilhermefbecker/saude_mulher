@extends('layouts.app')

@section('title', 'Gerenciar Artigos')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title">
            Artigos
        </h1>

        <p class="page-subtitle">
            Gerencie os artigos disponíveis no aplicativo.
        </p>

    </div>


    <!-- BOTÃO ADICIONAR -->

    <a
        href="{{ route('artigos.create') }}"
        class="btn btn-primary"
    >

        <i class="bi bi-plus-lg"></i>

        Novo artigo

    </a>

</div>


<!-- MENSAGEM DE SUCESSO -->

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

@endif


<!-- CARDS -->

<div class="row g-3 mb-4">

    <div class="col-md-4">

        <div class="card stat-card">

            <h6>
                Total de artigos
            </h6>

            <h2>
                {{ $artigos->count() }}
            </h2>

            <div class="stat-icon">

                <i class="bi bi-file-text"></i>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card stat-card">

            <h6>
                Artigos ativos
            </h6>

            <h2>
                {{ $artigos->where('status', true)->count() }}
            </h2>

            <div class="stat-icon">

                <i class="bi bi-check-circle"></i>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card stat-card">

            <h6>
                Artigos inativos
            </h6>

            <h2>
                {{ $artigos->where('status', false)->count() }}
            </h2>

            <div class="stat-icon">

                <i class="bi bi-eye-slash"></i>

            </div>

        </div>

    </div>

</div>


<!-- LISTA -->

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Artigos cadastrados
        </h5>

        <span class="text-muted">
            {{ $artigos->count() }} artigo(s)
        </span>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Imagem</th>

                        <th>Título</th>

                        <th>Status</th>

                        <th>Data</th>

                        <th class="text-end">
                            Ações
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($artigos as $artigo)

                    <tr>

                        <!-- ID -->

                        <td>
                            <strong>
                                #{{ $artigo->id }}
                            </strong>
                        </td>


                        <!-- IMAGEM -->

                        <td>

                            @if($artigo->imagem)

                                <img
                                    src="{{ asset('storage/' . $artigo->imagem) }}"
                                    class="article-image"
                                    alt="{{ $artigo->titulo }}"
                                >

                            @else

                                <div class="article-no-image">

                                    <i class="bi bi-image"></i>

                                </div>

                            @endif

                        </td>


                        <!-- TÍTULO -->

                        <td>

                            <strong>
                                {{ $artigo->titulo }}
                            </strong>

                            <br>

                            <small class="text-muted">

                                {{ Str::limit($artigo->conteudo, 80) }}

                            </small>

                        </td>


                        <!-- STATUS -->

                        <td>

                            @if($artigo->status)

                                <span class="badge badge-ativo">

                                    <i class="bi bi-check-circle"></i>

                                    Ativo

                                </span>

                            @else

                                <span class="badge badge-inativo">

                                    <i class="bi bi-eye-slash"></i>

                                    Inativo

                                </span>

                            @endif

                        </td>


                        <!-- DATA -->

                        <td>

                            {{ $artigo->created_at->format('d/m/Y') }}

                        </td>


                        <!-- AÇÕES -->

                        <td class="text-end">

                            <!-- EDITAR -->

                            <a
                                href="{{ route('artigos.edit', $artigo->id) }}"
                                class="btn btn-sm btn-warning"
                                title="Editar artigo"
                            >

                                <i class="bi bi-pencil"></i>

                            </a>


                            <!-- EXCLUIR -->

                            <form
                                action="{{ route('artigos.destroy', $artigo->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Tem certeza que deseja excluir este artigo?')"
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

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5"
                        >

                            <div class="empty-state">

                                <div class="empty-state-icon">

                                    <i class="bi bi-newspaper"></i>

                                </div>

                                <h5>
                                    Nenhum artigo cadastrado
                                </h5>

                                <p>
                                    Clique em "Novo artigo" para cadastrar.
                                </p>

                                <a
                                    href="{{ route('artigos.create') }}"
                                    class="btn btn-primary"
                                >

                                    <i class="bi bi-plus-lg"></i>

                                    Novo artigo

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection