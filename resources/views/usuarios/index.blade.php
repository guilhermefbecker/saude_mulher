@extends('layouts.app')

@section('title', 'Usuários')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title">
            Usuários
        </h1>

        <p class="page-subtitle">
            Gerencie os usuários que possuem acesso ao sistema.
        </p>

    </div>


    <a
        href="{{ route('usuarios.create') }}"
        class="btn btn-primary"
    >

        <i class="bi bi-person-plus"></i>

        Novo usuário

    </a>

</div>


@if(session('success'))

    <div class="alert alert-success">

        <i class="bi bi-check-circle"></i>

        {{ session('success') }}

    </div>

@endif


@if(session('error'))

    <div class="alert alert-danger">

        <i class="bi bi-exclamation-circle"></i>

        {{ session('error') }}

    </div>

@endif


<div class="card">

    <div class="card-header">

        <h5 class="mb-0">
            Usuários cadastrados
        </h5>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Nome</th>

                        <th>E-mail</th>

                        <th>Tipo</th>

                        <th>Cadastro</th>

                        <th class="text-end">
                            Ações
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($usuarios as $usuario)

                    <tr>

                        <td>
                            #{{ $usuario->id }}
                        </td>


                        <td>

                            <strong>
                                {{ $usuario->name }}
                            </strong>

                        </td>


                        <td>
                            {{ $usuario->email }}
                        </td>


                        <td>

                            @if($usuario->is_master)

                                <span class="badge bg-dark">
                                    <i class="bi bi-shield-check"></i>
                                    Admin Master
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Usuário
                                </span>

                            @endif

                        </td>


                        <td>

                            {{ $usuario->created_at->format('d/m/Y') }}

                        </td>


                        <td class="text-end">

                            @if(!$usuario->is_master)

                                <a
                                    href="{{ route('usuarios.edit', $usuario->id) }}"
                                    class="btn btn-sm btn-warning"
                                >

                                    <i class="bi bi-pencil"></i>

                                </a>


                                <form
                                    action="{{ route('usuarios.destroy', $usuario->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Deseja realmente excluir este usuário?')"
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

                            @else

                                <span class="text-muted">
                                    Conta protegida
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5"
                        >

                            Nenhum usuário cadastrado.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection