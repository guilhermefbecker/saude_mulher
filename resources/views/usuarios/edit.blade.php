@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title">
            Editar usuário
        </h1>

        <p class="page-subtitle">
            Altere os dados do usuário.
        </p>

    </div>


    <a
        href="{{ route('usuarios.index') }}"
        class="btn btn-secondary"
    >

        <i class="bi bi-arrow-left"></i>

        Voltar

    </a>

</div>


<div class="card">

    <div class="card-body p-4">

        <form
            action="{{ route('usuarios.update', $usuario->id) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            <div class="mb-3">

                <label class="form-label">
                    Nome
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $usuario->name) }}"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    E-mail
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $usuario->email) }}"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Nova senha
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                >

                <small class="text-muted">
                    Deixe vazio para manter a senha atual.
                </small>

            </div>


            <div class="mb-4">

                <label class="form-label">
                    Confirmar nova senha
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                >

            </div>


            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('usuarios.index') }}"
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