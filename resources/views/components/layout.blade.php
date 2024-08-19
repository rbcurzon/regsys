<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container-fluid overflow-hidden">
<header class="w-100 d-flex justify-content-end py-2 bg-primary">
    <div class="d-flex justify-content-between w-75 me-5">
        <div class="d-flex align-items-center">
            <h2 class="text-white d-flex align-items-center">
                <img src='/LOGIN_PAGE/software/pictures/registrar_logo.png' alt="Logo" class="logo"
                     style="width: 70px; height: 70px">
                CCC: College of the Registrar
            </h2>
        </div>
        <span class="h5 text-white text-uppercase ms-auto">
                <?= $title ?? "Title" ?>
            </span>
        <!-- <span class="h5 text-white text-uppercase">User ID</span> -->
    </div>
</header>
<div class="content" style="margin-left: 250px; ">
    {{ $slot }}
</div>
<div class="position-fixed top-0 start-0 d-flex flex-column flex-shrink-0 pt-5 bg-light border-end border-secondary"
 id="sidebar" style="width: 250px; height: 100vh; z-index: 1000;">
    <div class="container mt-5">
        <hr class="border-secondary">
        <ul class="nav flex-column gap-4">
            <li class="text-center">
                <a href="#" class="d-flex justify-content-center text-dark text-decoration-none"
                   aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="80" height="80" class="rounded-circle me-2">
                </a>
                <span class="h5 text-dark">user123</span>
            </li>
            @auth()

                <li class="nav-item">
                    <x-nav-link href="/transactions" :active="request()->is('transactions')" aria-current="page">
                        Home
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link href="/transactions/create" :active="request()->is('transactions/create')">
                        Create
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <form method="POST" action="/logout">
                        @csrf
                        <x-form-button value="Logout"/>
                    </form>
                </li>
            @endauth
            @guest()
                <li class="nav-item">
                    <x-nav-link href="/login" :active="request()->is('login')">
                        Login
                    </x-nav-link>
                </li>
            @endguest
        </ul>
    </div>
</div>
</body>


</html>
