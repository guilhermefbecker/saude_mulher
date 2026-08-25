@extends('layouts.app')

@section('title', 'Artigos')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title">
            Artigos
        </h1>

        <p class="page-subtitle">
            Gerencie os conteúdos publicados no aplicativo.
        </p>

    </div>


    <a
        href="{{ route('artigos.create') }}"
        class="btn btn-primary"
    >

        <i class="bi bi-plus-lg me-1"></i>

        Novo artigo

    </a>

</div>


<!-- ESTATÍSTICAS -->

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


<!-- TABELA -->

<div class="card">

    <div class="card-header">

        <h5 class="mb-0 fw-bold">
            Artigos cadastrados
        </h5>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

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

                        <td>
                            #{{ $artigo->id }}
                        </td>


                        <td>

                            @if($artigo->imagem)

                                <img
                                    src="{{ asset('storage/' . $artigo->imagem) }}"
                                    class="article-image"
                                    alt="Imagem do artigo"
                                >

                            @else

                                <div class="article-no-image">

                                    Sem imagem

                                </div>

                            @endif

                        </td>


                        <td>

                            <strong>
                                {{ $artigo->titulo }}
                            </strong>

                        </td>


                        <td>

                            @if($artigo->status)

                                <span class="badge badge-ativo">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Ativo

                                </span>

                            @else

                                <span class="badge badge-inativo">

                                    <i class="bi bi-eye-slash me-1"></i>

                                    Inativo

                                </span>

                            @endif

                        </td>


                        <td>

                            <span class="text-muted">

                                {{ $artigo->created_at->format('d/m/Y') }}

                            </span>

                        </td>


                        <td class="text-end">

                            <a
                                href="{{ route('artigos.edit', $artigo) }}"
                                class="btn btn-sm btn-warning"
                            >

                                <i class="bi bi-pencil"></i>

                            </a>


                            <form
                                action="{{ route('artigos.destroy', $artigo) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Deseja realmente excluir este artigo?')"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                >

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6">

                            <div class="empty-state">

                                <div class="empty-state-icon">

                                    <i class="bi bi-newspaper"></i>

                                </div>

                                <h5>
                                    Nenhum artigo cadastrado
                                </h5>

                                <p>
                                    Comece adicionando o primeiro artigo.
                                </p>

                                <a
                                    href="{{ route('artigos.create') }}"
                                    class="btn btn-primary"
                                >

                                    <i class="bi bi-plus-lg me-1"></i>

                                    Criar artigo

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