<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{ $title ?? "Title" }}</title>
</head>

<body class="font-sans bg-gray-100">

<header class="w-full mb-4">
    <div class="flex justify-center px-2 bg-blue-600">
        <div class="flex items-center">
            <img src='LOGIN_PAGE/software/pictures/registrar_logo.png' alt="Logo" class="logo w-16 h-16">
            <span class="text-white text-xl font-bold ml-2">CCC: College of the Registrar</span>
        </div>
    </div>
</header>


<div class="">
    @auth
        <aside class="fixed top-0 left-0 w-1/6 h-full bg-white border-r border-gray-300 pt-5">
            <div class="container mt-5 p-2">
                <nav class="flex flex-col pb-5 border-b border-indigo-900/10">
                    <a href="#" class="flex flex-col m-auto text-gray-50 hover:text-blue-600">
                        <img src="https://github.com/mdo.png" alt="" class="rounded-full mr-2 w-16 h-16">
                        <span class="text-lg text-gray-800 font-bold text-center">{{ Auth::id() }}</span>
                    </a>
                    <x-nav-link href="/" :active="request()->is('/')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>Home</x-nav-link>
                    <x-nav-link href="/transactions/create" :active="request()->is('transactions/create')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>Create
                    </x-nav-link>
                </nav>

                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="flex text-indigo-800 text-lg px-4 py-2 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>
    @endauth
</div>

<main class="">

    {{ $slot }}

</main>


