<div>
    {{-- Si el modal está activo --}}
    @if ($showModalTurno)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div class="bg-gray-800 text-white p-6 rounded-xl shadow-xl w-96">
                <h2 class="text-xl font-bold mb-4">🟢 Abrir turno</h2>
                <p class="mb-3 text-gray-300">Debes abrir un turno para comenzar a facturar.</p>

                <label for="opening_amount" class="block mb-2 text-sm">Monto base en caja:</label>
                <input type="number" step="0.01" wire:model="opening_amount"
                    class="w-full text-black rounded p-2 mb-4" placeholder="Ejemplo: 50000">

                <div class="flex justify-between">
                    <button wire:click="abrirTurno"
                        class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-white font-bold">
                        <i class="fa-solid fa-money-bill-1-wave"></i> Abrir turno
                    </button>

                    <button onclick="window.location.href='{{ route('home') }}'"
                        class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white font-bold">
                        <i class="fa-solid fa-square-xmark"></i> Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (!$showModalTurno)
        <div 
            x-data="{ codigo: '' }" 
            @keydown.f8.window="$wire.facturar()"
            @keydown.f9.window="$dispatch('open-expense-modal')"
            class="p-6 w-full max-w-5xl mx-auto"
            >
            {{-- Título --}}
            <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100 text-center">
                <i class="fa-solid fa-newspaper"></i> Facturación
            </h1>
        
            {{-- Input del código --}}
            <div class="mb-6 flex items-center gap-3">
                <input type="text" wire:model="codigo" wire:keydown.enter.prevent="buscarProducto"
                placeholder="Escanea o escribe el código"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 
                        focus:ring-2 focus:ring-blue-500 focus:outline-none 
                        bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100"
                />
                <button @click="$wire.buscarProducto(codigo); codigo=''"
                    class="px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition"> Buscar
                </button>
            </div>
        
            {{-- Imprimir y Metodos de pago  --}}
            <div class="flex items-center justify-between mb-3">
                <!--Switch de auto impresión -->
                <div class="flex items-center gap-3">

                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-print text-2xl text-gray-300"></i>
                        <span class="text-lg text-gray-300 dark:text-gray-200">Auto-imprimir</span>
                    </div>

                    <!-- Switch grande -->
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="autoPrint" class="sr-only peer">
                        <div class="w-16 h-8 bg-gray-300 peer-focus:outline-none dark:bg-gray-700 rounded-full peer peer-checked:bg-blue-600 transition-all duration-300"></div>
                        <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full shadow-md peer-checked:translate-x-8 transition-all duration-300"></div>
                    </label>
                </div>
                {{-- Metodos de pago  --}}
                <div class="flex gap-3">
                    <button
                        wire:click="$set('payment_method', 'Efectivo')"
                        class="px-4 py-2 rounded-lg border text-lg font-semibold
                        {{ $payment_method === 'Efectivo' 
                            ? 'bg-blue-600 text-white border-blue-700' 
                            : 'bg-gray-200 dark:bg-gray-700 dark:text-white' }}">
                        <i class="fa-solid fa-money-bill-1"></i> Efectivo
                    </button>

                    <button
                        wire:click="$set('payment_method', 'Transferencia')"
                        class="px-4 py-2 rounded-lg border text-lg font-semibold
                        {{ $payment_method === 'Transferencia' 
                            ? 'bg-blue-600 text-white border-blue-700' 
                            : 'bg-gray-200 dark:bg-gray-700 dark:text-white' }}">
                        <i class="fa-solid fa-money-bill-transfer"></i> Transferencia
                    </button>

                    <button
                        wire:click="$set('payment_method', 'Banco')"
                        class="px-4 py-2 rounded-lg border text-lg font-semibold
                        {{ $payment_method === 'Banco' 
                            ? 'bg-blue-600 text-white border-blue-700' 
                            : 'bg-gray-200 dark:bg-gray-700 dark:text-white' }}">
                        <i class="fa-solid fa-credit-card"></i> Banco
                    </button>
                </div>
            </div>



            {{-- Tabla de productos --}}
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left"></th>
                            <th class="px-4 py-2 text-left">Producto</th>
                            <th class="px-4 py-2 text-center">Unidad</th>
                            <th class="px-4 py-2 text-right">Cantidad / Peso</th>
                            <th class="px-4 py-2 text-right">Precio</th>
                            <th class="px-4 py-2 text-right">Subtotal</th>
                            <th class="px-4 py-2 text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $key => $item)
                            <tr wire:key="item-{{ $key }}" class="border-t border-gray-200 dark:border-gray-700">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $item['name'] }}</td>
                                <td class="px-4 py-2 text-center">{{ strtoupper($item['unit_type']) }}</td>
        
                                <td class="px-4 py-2 text-right">
                                    @if ($item['unit_type'] === 'kl')
                                        <input type="number" step="0.01" min="0"
                                            wire:change="actualizarPeso('{{ $key }}', $event.target.value)"
                                            value="{{ $item['weight'] }}"
                                            class="w-24 text-right border rounded px-2 py-1 bg-transparent border-gray-300 dark:border-gray-700"
                                            placeholder="KL"
                                        />
                                    @else
                                        <input type="number" min="1"
                                            wire:change="actualizarCantidad('{{ $key }}', $event.target.value)"
                                            value="{{ $item['quantity'] }}"
                                            class="w-20 text-right border rounded px-2 py-1 bg-transparent border-gray-300 dark:border-gray-700"
                                            placeholder="Cant."
                                        />
                                    @endif
                                </td>
        
                                <td class="px-4 py-2 text-right">${{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td class="px-4 py-2 text-right font-semibold">${{ number_format($item['subtotal'], 0, ',', '.') }}</td>
        
                                <td class="px-4 py-2 text-center">
                                    <button wire:click="eliminarItem('{{ $key }}')" class="text-red-500 hover:text-red-700"
                                        title="Eliminar producto"><i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500 dark:text-gray-400">
                                    No hay productos en la factura
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            {{-- Total --}}
            <div class="mt-6 flex justify-end">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Ítems: <span class="font-semibold">{{ count($items) }}</span>
                </p>&nbsp;&nbsp;
                <div class="text-right">
                    <p class="text-lg text-gray-700 dark:text-gray-200 font-semibold">Total:</p>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">${{ number_format($total, 0, ',', '.') }}</p>
                </div>
            </div>
            
            {{-- Atajos--}}
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-4 text-center">
                | <span class="font-semibold">F8</span> Facturar |
                <span class="font-semibold">F9</span> Gastos |
            </p><hr>

            {{-- Tabla Facturas --}} 
            <div class="mt-6 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Turno abierto: {{ $shift->opened_at->format('d/m/Y h:i A') }}
                    </p>
                </div>
                <div class="flex items-center space-x-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        N.Facturas: {{ $facturas->count() }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        T.Vendido: $ {{ number_format($facturas->sum('total')) }}
                    </p>
                </div>
            </div>

            <div class="table-wrapper max-h-80 overflow-y-auto rounded border dark:border-gray-700">
                <table class="table-sticky min-w-full border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                        <tr>
                            <th class="p-2">Nº</th>
                            <th class="p-2">Factura</th>
                            <th class="p-2">Fecha</th>
                            <th class="p-2">Pago</th>
                            <th class="p-2">Total</th>
                            <th class="p-2">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($facturas as $index => $factura)
                        <tr>
                            <td class="p-2 text-center">{{$index + 1}}</td>
                            <td class="p-2 text-center">{{str_pad($factura->id, 8, '0', STR_PAD_LEFT) }}</td>
                            <td class="p-2">{{ $factura->created_at->format('d/m/Y h:i A') }}</td>
                            <td class="p-2">{{ $factura->payment_method }}</td>
                            <td class="p-2 text-right">$ {{ number_format($factura->total) }}</td>
                            <td class="p-2 text-center">{{ $factura->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br> <div class="flex items-center justify-between mb-3">
                <!--Switch de auto impresión -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <button wire:click="$dispatch('open-expense-modal')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <i class="fa-solid fa-file-zipper"></i> Gastos
                        </button>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button 
                        wire:click="$set('showReporte', true)"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fa-regular fa-file-zipper"></i> Ver Reporte
                    </button>&nbsp;&nbsp;
                    <button 
                        wire:click="$set('modalCerrarTurno', true)"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        <i class="fa-solid fa-xmark"></i> Cerrar turno
                    </button>
                </div>
            </div>



        </div>
    @endif

    @if($modalCerrarTurno)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-xl w-96">
                
                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">
                    Confirmar cierre de turno
                </h2>

                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    ¿Seguro que deseas cerrar el turno? Una vez cerrado no podrás agregar más ventas.
                </p>

                <label for="opening_amount" class="block mb-2 text-sm">Monto total cierre caja sin la base:</label>
                <input type="number" step="0.01" wire:model="closing_amount"
                    class="w-full text-black rounded p-2 mb-4" placeholder="Ejemplo: 100000">

                <label for="opening_amount" class="block mb-2 text-sm">Total Gastos:</label>
                <input type="number" step="0.01" wire:model="total_expenses"
                    class="w-full text-black rounded p-2 mb-4" placeholder="Ejemplo: 50000">

                <hr>
                <div class="space-y-1 text-gray-400">
                    <p>Efectivo: <span class="text-gray-200 font-semibold">$ {{ number_format($facturas->where('payment_method', 'Efectivo')->sum('total')) }}</span></p>
                    <p>Banco: <span class="text-gray-200 font-semibold">$ {{ number_format($facturas->where('payment_method', 'Banco')->sum('total')) }}</span></p>
                    <p>Transferencia: <span class="text-gray-200 font-semibold">$ {{ number_format($facturas->where('payment_method', 'Transferencia')->sum('total')) }}</span></p>
                    <p>T. Ventas: <span class="text-gray-200 font-semibold">$ {{ number_format($facturas->sum('total')) }}</span></p>
                </div>                
                <hr>

                <div class="flex justify-end mt-4 space-x-2">
                    <!-- Confirmar -->
                    <button wire:click="cerrarTurno" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        <i class="fa-solid fa-file-arrow-down"></i> Sí, cerrar
                    </button>
                    <!-- Cancelar -->
                    <button wire:click="$set('modalCerrarTurno', false)" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white rounded">
                        Cancelar
                    </button>
                </div>
            </div>

        </div>
    @endif

    <livewire:expenses />

    @includeWhen($showReporte, 'livewire.reports.reporte-turno')
</div>