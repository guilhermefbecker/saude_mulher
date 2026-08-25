@extends('layouts.app')

@section('title', 'Novo Usuário')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title">
            Novo usuário
        </h1>

        <p class="page-subtitle">
            Cadastre um novo usuário para acessar o sistema.
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
            action="{{ route('usuarios.store') }}"
            method="POST"
        >

            @csrf


            <div class="mb-3">

                <label class="form-label">
                    Nome
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
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
                    value="{{ old('email') }}"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Senha
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required
                >

            </div>


            <div class="mb-4">

                <label class="form-label">
                    Confirmar senha
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required
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

                    <i class="bi bi-person-plus"></i>

                    Cadastrar usuário

                </button>

            </div>

        </form>

    </div>

</div>

@endsection