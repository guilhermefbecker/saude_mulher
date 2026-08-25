<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - Minha Saúde Mulher</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <link
        rel="stylesheet"
        href="{{ asset('css/login.css') }}"
    >

</head>


<body>

<div class="login-container">


    <div class="login-card">


        <!-- LOGO -->

        <div class="login-logo">

            <div class="logo-icon">

                <i class="bi bi-heart-pulse"></i>

            </div>

            <h2>
                Minha Saúde Mulher
            </h2>

            <p>
                Painel administrativo
            </p>

        </div>


        <!-- FORMULÁRIO -->

        <form
            action="{{ route('login.submit') }}"
            method="POST"
        >

            @csrf


            @if($errors->any())

                <div class="alert alert-danger">

                    {{ $errors->first() }}

                </div>

            @endif


            <!-- EMAIL -->

            <div class="mb-3">

                <label class="form-label">
                    E-mail
                </label>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="bi bi-envelope"></i>

                    </span>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Digite seu e-mail"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >

                </div>

            </div>


            <!-- SENHA -->

            <div class="mb-3">

                <label class="form-label">
                    Senha
                </label>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="bi bi-lock"></i>

                    </span>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Digite sua senha"
                        required
                    >

                </div>

            </div>


            <!-- LEMBRAR -->

            <div class="form-check mb-4">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember"
                    id="remember"
                >

                <label
                    class="form-check-label"
                    for="remember"
                >
                    Lembrar de mim
                </label>

            </div>


            <!-- BOTÃO -->

            <button
                type="submit"
                class="btn btn-login w-100"
            >

                <i class="bi bi-box-arrow-in-right"></i>

                Entrar

            </button>

        </form>


    </div>

</div>

</body>

</html>