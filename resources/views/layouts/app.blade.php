<!DOCTYPE html>
<html lang="es" class="h-full bg-gray-100 dark:bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Carnicería POS' }}</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/solid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/regular.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- <!-- Tailwind CDN + modo oscuro --> --}}
    <script src="{{ asset('css/tailwind.css') }}"></script> 

    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    @livewireStyles
</head>

<body class="h-full flex bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-950 text-gray-800 dark:text-gray-100 shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
        
        <div class="p-5 flex items-center justify-between border-b border-gray-200 dark:border-gray-800">
            <img src="{{ asset('img/logo.png') }}" width="50px"><h1 class="font-bold text-red-600">Capital POS</h1>
            <button id="closeSidebar" class="md:hidden text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                ✖️
            </button>
        </div>

        @php
            $claseBase = 'block px-4 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900 transition';
            $claseActiva = 'bg-blue-500 text-white dark:bg-blue-500';
            $activeRoute = fn ($name) => Route::currentRouteName() === $name ? $claseActiva : '';
        @endphp

        <nav class="p-4 space-y-2">  
            <a href="{{ route('home') }}" class="{{ $claseBase }} {{ $activeRoute('home') }}"><i class="fa-solid fa-home"></i> Inicio</a>     
            {{-- <a href="/home" class="block px-4 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900 transition"><i class="fa-solid fa-home"></i> Inicio</a> --}}
            @if(array_key_exists('FACTURC', session('permissions', [])))
                <a href="{{ route('billing') }}" class="{{ $claseBase }} {{ $activeRoute('billing') }}"><i class="fa-solid fa-cash-register mr-2"></i> Facturar</a>  
            @endif
            @if(array_key_exists('VRPRDTS', session('permissions', [])))
                <a href="{{ route('products') }}" class="{{ $claseBase }} {{ $activeRoute('products') }}"><i class="fa-solid fa-list-check"></i> Productos</a>
            @endif
            @if(array_key_exists('GSTINVN', session('permissions', [])))
                <a href="{{ route('providers') }}" class="{{ $claseBase }} {{ $activeRoute('providers') }}"><i class="fa-solid fa-box"></i> Proveedores</a>
            @endif
            @if(array_key_exists('GSTINVN', session('permissions', [])))
                <a href="{{ route('workers') }}" class="{{ $claseBase }} {{ $activeRoute('workers') }}"><i class="fa-solid fa-people-line"></i> Trabajadores</a>
            @endif
            @if(array_key_exists('VRFINNZ', session('permissions', [])))
                <a href="{{ route('sales') }}" class="{{ $claseBase }} {{ $activeRoute('sales') }}"><i class="fa-solid fa-chart-line"></i> Ventas</a>
            @endif
            @if(array_key_exists('VERUSRS', session('permissions', [])))
                <a href="{{ route('users') }}" class="{{ $claseBase }} {{ $activeRoute('users') }}"><i class="fa-solid fa-user"></i> Usuarios</a>
            @endif
            @if(array_key_exists('CONFSYST', session('permissions', [])))
                <a href="{{ route('settings') }}" class="{{ $claseBase }} {{ $activeRoute('settings') }}"><i class="fa-solid fa-gear mr-2"></i> Configuración</a>
            @endif
        </nav>
    </aside>

    <!-- Contenedor principal -->
    <div class="flex-1 flex flex-col min-h-screen md:ml-64 transition-all duration-300">

        <!-- Navbar superior -->
        <header class="sticky bg-white dark:bg-black shadow flex items-center justify-between p-4 transition-all duration-300">
            <button id="openSidebar" class="md:hidden text-gray-600 dark:text-gray-200 text-2xl"><i class="fa-solid fa-bars"></i></button>
            <h1 class="text-lg font-semibold">{{ $title ?? 'Panel de Control' }}</h1>

            <div class="flex items-center gap-3">
                <!-- Botón de tema -->
                <button id="themeToggle"
                    class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    <i class="fa-solid fa-sun"></i>
                </button>


                <div class="relative" x-data="{ open: false }">
                    <!-- Botón que abre el dropdown -->
                    <button @click="open = !open" 
                            class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        &nbsp;<span class="text-sm text-gray-600 dark:text-gray-300">
                            {{ session('userName') }}
                        </span>&nbsp;
                        <i class="fa-solid fa-list-ul"></i>&nbsp;
                    </button>
                    <!-- Dropdown -->
                    <div x-show="open"
                        @click.outside="open = false"
                        class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 shadow-lg rounded-lg py-2 z-50">

                    

                        <form method="GET" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 dark:hover:bg-red-900">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i> Cerrar sesión
                            </button>
                        </form>

                    </div>
                </div>


            </div>
        </header>

        <!-- Contenido principal -->
        <main class="flex-1 p-6 bg-gray-100 dark:bg-gray-950 transition-all duration-300">
            {{ $slot }}
        </main>

        <!-- Footer -->
        {{-- <footer class="bg-gray-200 dark:bg-gray-900 text-center py-3 text-sm text-gray-600 dark:text-gray-400 transition-all duration-300">
            © 2025 NewPost
        </footer> --}}
    </div>

    @livewireScripts
    <script src="{{ asset('js/app.js?v2') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    @if (isset($script))
        <script type="module" src="{{ asset('js/livewire/' . $script . '.js?v=1.0.0') }}"></script>
    @endif

</body>
</html>
