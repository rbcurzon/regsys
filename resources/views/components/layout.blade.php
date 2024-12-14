@php use App\Models\Transaction;use Illuminate\Support\Facades\Auth; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', '')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden; /* Prevent horizontal scroll */
            background-color: #f0f0f0; /* Light gray background */
        }


        header {
            z-index: 10;
            position: relative;
            background-color: rgb(0, 0, 85);
        }

        /* Sidebar - hidden by default in mobile view */
        aside {
            position: absolute;
            top: 130px; /* Adjust this if necessary to match your header height */
            left: 0;
            width: 205px; /* Fixed width for larger screens */
            /*height: calc(100vh - 130px); !* Use the header height here *!*/
            /*border: 1px solid black;*/
            /*border-radius: 0 10px 10px 0;*/
            padding-top: 1rem;
            transition: transform 0.3s ease;
            transform: translateX(0); /* Visible by default on larger screens */
            z-index: 9;
        }

        /* Show sidebar when 'open' class is added */
        aside.open {
            transform: translateX(0); /* Visible when 'open' */
        }

        /* Style for the toggle button */
        .burger {
            cursor: pointer;
            color: darkblue;
            font-size: 2rem;
            display: none; /* Hidden by default */
        }

        /* Sidebar Label Styles */
        .sidebar-label {
            transition: opacity 0.3s ease;
        }

        @media (max-width: 768px) {
            aside {
                width: 205px; /* Keep this width for larger screens */
                transform: translateX(-100%); /* Hidden by default */
                height: calc(100vh - 130px); /* Adjust height for mobile */
            }

            aside.open {
                transform: translateX(0); /* Show sidebar when 'open' */
                /*position: fixed;*/
                position: absolute;
                height: 100svh;
                top: 130px; /* Maintain the position below the header */
                left: 0;
                width: 205px; /* Fixed width on mobile */
                /*height: calc(100vh - 130px); !* Adjust height for mobile *!*/
                z-index: 10; /* Ensure it's on top */
            }

            .sidebar-label {
                opacity: 0; /* Hide labels but keep space */
                visibility: hidden; /* Ensure it doesn't interfere with layout */
            }

            aside.open .sidebar-label {
                opacity: 1; /* Show labels when the sidebar is open */
                visibility: visible; /* Ensure they are visible */
            }

            .sidebar-icon {
                display: block;
                width: 24px;
                height: 24px;
            }

            .burger {
                /*display: block; !* Show burger icon on smaller screens *!*/
            }
        }

        /* Optional: If you want the sidebar to be less wide on very small screens */
        @media (max-width: 480px) {
            aside.open {
                width: 180px; /* Adjust width further for very small screens */
            }
        }

        /* Completely hide sidebar below 480px */
        /* Default max-width: 480px */
        @media (max-width: 1200px) {
            aside {
                transform: translateX(-100%); /* Hide sidebar fully on mobile */
            }
        }

        /* Apply Montserrat font styles */
        .montserrat-regular {
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
        }

        .montserrat-bold {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }

        .text-shadow-white {
            position: relative;
            z-index: 50;
            color: white !important;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js "></script>
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css " rel="stylesheet">
    @bukStyles(true)
</head>

<body class="font-sans montserrat-regular relative">
@auth()
    <!-- header start -->
    <header class="grid grid-cols-3 w-full mb-3 items-center min-h-20 px-3 py-2 z-0">
        <div class="col-start-1 col-span-2 sm:col-span-2 flex justify-end items-center flex-nowrap">
            <img class="col-start-1 ml-0 rounded-full h-16 w-16 sm:h-24 sm:w-24 bg-blue-200 text-center"
                 alt="brand logo"
                 src="{{ asset('/images/registrar-logo.png') }}">
            <div
                class="text-white text-sm sm:text-2xl font-bold ml-2 uppercase montserrat-bold z-50 text-shadow-white">
                city college of calamba
            </div>
        </div>
        <div class="col-start-3 flex justify-end">
            <div>
                @guest()
                    <div
                        class="text-white text-base sm:text-xl font-bold ml-2 uppercase montserrat-bold text-shadow-white">
                        @yield('title', '')
                    </div>
                @endguest
                @auth()
                    <div
                        class="text-white text-sm sm:text-xl font-bold ml-2 uppercase montserrat-bold text-shadow-white">
                        @yield('title', '')
                    </div>
                    <div class="text-sm sm:text-base text-white ml-2 uppercase montserrat-regular text-shadow-white">
                        id: {{ Auth::user()->getStudentId() }}
                    </div>
                @endauth
            </div>
        </div>
    </header>
@endauth()
<!-- header end -->

@auth
    <!-- sidebar start -->
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-blue-900" aria-label="Sidebar">
    <nav class="flex flex-col space-y-4 pb-5 px-2 mt-6">
            <a href="/profile"
               class="flex flex-col justify-center items-center mb-3 text-white hover:text-blue-600">
                <img src="{{ asset('/images/profile-icon-design-free-vector.jpg') }}" alt=""
                     class="rounded-full w-20 h-20 ">
                <span
                    class="text-lg font-bold text-center montserrat-regular">{{ Auth::user()->getFirstNameAndLastNameAbbreviation() }}</span>
            </a>
            <x-nav-link href="/" class="mb-2" :active="request()->is('/')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="black" class="size-6 sidebar-icon">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>
                <span
                    class='flex flex-col justify-center items-center h-full text-black font-bold text-base montserrat-bold'>Dashboard</span>
            </x-nav-link>
            @can('create', Transaction::class)
                <x-nav-link href="/transactions/create" :active="request()->is('transactions/create')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="black" class="size-6 sidebar-icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                    </svg>
                    <span
                        class='flex flex-col justify-center items-center h-full text-black font-bold text-base montserrat-bold'>Request</span>
                </x-nav-link>
            @endcan
            <form method="POST" action="/logout">
                <div
                    class="w-full flex text-black text-base h-10 bg-white cursor-pointer select-none active:translate-y-2 active:[box-shadow:0_0px_0_0_#1b6ff8,0_0px_0_0_#1b70f841] active:border-b-[0px] transition-all duration-150 [box-shadow:0_5px_0_0_#1b6ff8,0_10px_0_0_#1b70f841] rounded-[15px] border-[1px] border-blue-400 py-2 font-medium space-x-3 montserrat-regular">
                    @csrf
                    <label for="logout"
                           class="flex-1 flex justify-items-start items-center h-full text-black font-bold text-base montserrat-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="black" class="size-6 sidebar-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/>
                        </svg>
                        <span class="ps-3 montserrat-bold">Logout</span>
                    </label>
                    <input type="submit" id="logout" value="Logout" class="hidden">
                </div>
            </form>
        </nav>
    </aside>
@endauth
<!-- sidebar end -->

<!-- Include script to toggle sidebar -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('open');
        // sidebar.classList.toggle("translate-x-full");
        // sidebar.classList.toggle("translate-x-0");
    }
</script>

<!-- Main content -->
<main class="montserrat-regular">
    @yield('content')
</main>


@include('sweetalert::alert')
@bukScripts(true)
</body>
</html>
