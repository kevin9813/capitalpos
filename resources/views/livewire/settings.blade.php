<div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-md">

    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200 text-center">
        Configuración de la Compañía
    </h2>

    {{-- Preview del logo centrada --}}
    @if ($logoPreview)
        <div class="flex justify-center mb-6">
            <img src="{{ $logoPreview }}" class="h-24 w-24 object-contain rounded-md border border-gray-200 dark:border-gray-700">
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-5">

        {{-- Nombre y NIT en la misma línea --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                <input type="text" wire:model="name"
                    class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- NIT --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIT</label>
                <input type="text" wire:model="nit"
                    class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500">
                @error('nit') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Slogan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slogan</label>
            <textarea wire:model="slogan" rows="2"
                class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('slogan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" wire:model="email"
                class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Input File y Estado en la misma línea --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            {{-- Input file --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Logo</label>
                <input type="file" wire:model="logo"
                    class="mt-1 block w-full text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg p-2 bg-white dark:bg-gray-800 transition">
                @error('logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Estado --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                <select wire:model="status" disabled
                    class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1">Activo</option>
                </select>
            </div>
        </div>

        {{-- Botón --}}
        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-semibold rounded-lg transition">
                <i class="fa-solid fa-floppy-disk"></i> Guardar
            </button>
        </div>

    </form>
</div>
