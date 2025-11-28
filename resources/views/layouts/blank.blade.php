<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <script src="{{ asset('css/tailwind.css') }}"></script> 
    @livewireStyles
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    {{-- Contenido del componente Livewire --}}
    <main class="flex items-center justify-center w-full h-full">
        {{ $slot }}
    </main>
    
    @livewireScripts
</body>
</html>