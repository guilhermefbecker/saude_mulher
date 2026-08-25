<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Minha Saúde Mulher')
    </title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <!-- CSS -->

    <link
        rel="stylesheet"
        href="{{ asset('css/artigos.css') }}"
    >

    @yield('styles')

</head>


<body>


<div class="container-fluid">

    <div class="row">


        <!-- ============================= -->
        <!-- SIDEBAR -->
        <!-- ============================= -->

        <aside class="col-md-2 px-0 sidebar">

            <div class="sidebar-brand">

                <h4>
                    Minha Saúde Mulher
                </h4>

                <span>
                    Painel administrativo
                </span>

            </div>


            <nav class="nav flex-column">


                <a
                    href="{{ route('artigos.index') }}"
                    class="nav-link active"
                >

                    <i class="bi bi-newspaper"></i>

                    Artigos

                </a>


                <a
                    href="#"
                    class="nav-link"
                >

                    <i class="bi bi-people"></i>

                    Usuários

                </a>


                <a
                    href="#"
                    class="nav-link"
                >

                    <i class="bi bi-gear"></i>

                    Configurações

                </a>


            </nav>

        </aside>


        <!-- ============================= -->
        <!-- CONTEÚDO -->
        <!-- ============================= -->

        <main class="col-md-10 content">

            @yield('content')

        </main>


    </div>

</div>


<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


@yield('scripts')


</body>

</html>