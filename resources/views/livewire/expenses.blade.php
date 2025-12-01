<div>    
    @if($showModalGastos)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white text-black dark:bg-gray-900 dark:text-white rounded-xl shadow-lg w-full max-w-md p-6">

                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">
                    Gastos
                </h2>

                <div class="max-h-64 overflow-y-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-300">
                            <th>Descripción</th>
                            <th>Valor</th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $exp)
                            <tr class="border-b border-gray-300">
                                <td>{{ $exp->description }}</td>
                                <td>${{ number_format($exp->price, 0) }}</td>
                                {{-- <td>
                                    @if($exp->status)
                                        <button 
                                            wire:click="confirmInactivate({{ $exp->id }})"
                                            class="px-3 py-1 bg-red-600 text-white rounded">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <br>

                
                <label class="block mb-2 text-sm">Descripcio:n</label>
                <input type="text" step="0.01"  wire:model="description"
                    class="w-full text-black rounded p-2 mb-4" placeholder="Ejemplo: Recogida, Pago..">

                <label class="block mb-2 text-sm">Valor:</label>
                <input type="text" wire:model.live="price"class="w-full text-black rounded p-2 mb-4"
                        placeholder="Ejemplo: 50.000">

           
                <hr>
                <div class="flex justify-end mt-4 space-x-2">
                    <!-- Confirmar -->
                    <button  wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fa-solid fa-file-arrow-down"></i> Guardar
                    </button>
                    <!-- Cancelar -->
                    <button wire:click="$set('showModalGastos', false)" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white rounded">
                        Cerrar
                    </button>
                </div>

            </div>
        </div>
    @endif
</div>
