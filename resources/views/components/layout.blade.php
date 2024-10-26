@php use App\Models\Transaction; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title', '')</title>
    {{--    <title>{{ $title ?? "Title" }}</title>--}}
</head>

<body class="font-sans relative">
<header class="static grid grid-cols-3 w-full mb-3 bg-blue-900 items-center min-h-20 px-3 py-2">
    <div class="col-start-2 flex justify-center items-center flex-nowrap">
        <img class="col-start-1 ml-0 rounded-full h-20 w-20 bg-blue-200 text-center" alt="brand logo" src="{{ asset('/images/REGISTRAR LOGO.png') }}"></img>
        <div class="text-white text-2xl font-bold ml-2 uppercase">city college of calamba</div>
    </div>
    <div class="col-start-3 flex justify-end">
        <div>
            @guest()
                <div class="text-white text-xl font-bold ml-2 uppercase">@yield('title', '')</div>
            @endguest
            @auth()
                <div class="text-white text-xl font-bold ml-2 uppercase">@yield('title', '')</div>
                <div class="text-white text-base ml-2 uppercase">id: @yield('student_id', '')</div>
            @endauth
        </div>
    </div>
</header>
@auth
    <aside class="absolute inset-y-0 left-0  w-52 h-svh border border-black rounded-r-md bg-blue-900 pt-5">
        <div class="container mt-5 px-3 py-2">
            <nav class="flex flex-col space-y-4 pb-5 border-b border-white">
                <a href="/profile" class="flex flex-col justify-center items-center m-auto text-white hover:text-blue-600">
                    <img src="{{ asset('/images/profile-icon-design-free-vector.jpg') }}" alt="" class="rounded-full w-16 h-16">
                    <span class="text-base font-bold text-center"> @yield('student_id')</span>
                </a>
                <x-nav-link href="/" :active="request()->is('/')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="black" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                    </svg>
                    <span
                        class='flex flex-col justify-center items-center h-full text-black font-bold text-base '>Home</span>
                </x-nav-link>
                @can('create', Transaction::class)
                    <x-nav-link href="/transactions/create" :active="request()->is('transactions/create')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="black" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                        </svg>
                        <span
                            class='flex flex-col justify-center items-center h-full text-black font-bold text-base '>Create</span>
                    </x-nav-link>
                @endcan
                <form method="POST" action="/logout">
                    <div class="w-full flex text-black text-base h-10 bg-white  cursor-pointer select-none
                            active:translate-y-2  active:[box-shadow:0_0px_0_0_#1b6ff8,0_0px_0_0_#1b70f841]
                            active:border-b-[0px]
                            transition-all duration-150 [box-shadow:0_5px_0_0_#1b6ff8,0_10px_0_0_#1b70f841]
                            rounded-[15px] border-[1px] border-blue-400
                            py-2 font-medium space-x-3">
                        @csrf

                        <label for="logout"
                               class="flex-1 flex justify-items-start items-center h-full text-black font-bold text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="black" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/>
                            </svg>
                            <span class="ps-3">Logout</span>
                        </label>
                        <input type="submit" id="logout" value="">
                    </div>
                </form>
            </nav>
        </div>
    </aside>
@endauth
{{--main start--}}
@yield('content')
{{--main end--}}
</body>
