<div class="w-full max-w-sm bg-white p-6 rounded-2xl shadow-lg" x-data="{ show: false }">
    <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Iniciar Sesión</h1>

    @if($errorMessage)
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-center">
            {{ $errorMessage }}
        </div>
    @endif

    <form wire:submit.prevent="login">
        {{-- Usuario --}}
        <div class="mb-4">
            <label for="usuario" class="block text-gray-700 mb-1">Usuario</label>
            <input type="text" id="usuario" wire:model="usuario" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        </div>

        {{-- Contraseña con toggle --}}
        <div class="mb-4" x-data="{ show: false }">
            <label for="password" class="block text-gray-700 mb-1">Contraseña</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password" wire:model="password" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10" />
                
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.458 12C2.732 16.057 6.523 19 11 19a9.956 9.956 0 004.905-1.357m2.727-2.727A10.473 10.473 0 0020.542 12C19.268 7.943 15.477 5 11 5c-.978 0-1.926.127-2.823.364M3 3l18 18" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Botón --}}
        <div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-150">
                Ingresar
            </button>
        </div>
    </form>

    <p class="text-center text-gray-500 text-sm mt-4">© 2025</p>
</div>
