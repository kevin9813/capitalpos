@if($showReporte)
<div id="modal-reporte" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
     wire:click.self="$set('showReporte', false)">

    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-xl w-[90%] max-w-3xl">
        
        <div class="max-h-[80vh] overflow-y-auto p-6">
         <!-- HEADER -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold tracking-wide"><i class="fa-solid fa-file-zipper"></i> Reporte del Turno</h1>
            <h2 class="text-lg font-semibold mt-1">{{session('companyName')}}</h2>
            <p class="text-sm text-gray-400">NIT: {{session('companyNit')}}</p>
        </div>

        <hr class="border-gray-700 mb-6">

        {{-- Información general del turno --}}
        <div class="space-y-3">
            <div>
                <span class="font-semibold text-gray-300">Cajero:</span>
                <span class="text-gray-400">{{ auth()->user()->name }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-300">Turno:</span>
                <span class="text-gray-400">
                    {{-- Fecha de Apertura (siempre se muestra) --}}
                    {{ $shift->opened_at->format('d/m/Y h:i A') }} - 

                    {{-- VALIDACIÓN --}}
                    @if ($shift->status == 'open')
                        {{-- Si el estado es 'open', muestra la fecha actual --}}
                        {{ date('d/m/Y h:i A') }}
                    @else
                        {{-- Si el estado NO es 'open' (es 'closed' o similar), muestra la fecha de cierre --}}
                        {{ $shift->closed_at->format('d/m/Y h:i A') }}
                    @endif
                </span>
            </div>
            <div>
                <span class="font-semibold text-gray-300">Facturas:</span>
                <span class="text-gray-400">{{ $facturas->count() }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-300">Base:</span>
                <span class="text-gray-400">$ {{ number_format($shift->opening_amount) }}</span>
            </div>
            <div class="pt-2">
                <span class="font-semibold text-gray-300 text-lg">Total vendido:</span>
                <span class="text-blue-400 font-bold text-lg">$ {{ number_format($facturas->sum('total')) }}</span>
            </div>
        </div>

        <hr class="border-gray-700 my-6">

        <!-- MÉTODOS DE PAGO -->
        <div>
            <h3 class="font-semibold text-gray-300 mb-3 text-lg">Totales por método de pago:</h3>

            <div class="space-y-1 text-gray-400">
                <p>Efectivo: <span class="text-gray-200 font-semibold">$ {{ number_format($facturas->where('payment_method', 'Efectivo')->sum('total')) }}</span></p>
                <p>Banco: <span class="text-gray-200 font-semibold">$ {{ number_format($facturas->where('payment_method', 'Banco')->sum('total')) }}</span></p>
                <p>Transferencia: <span class="text-gray-200 font-semibold">$ {{ number_format($facturas->where('payment_method', 'Transferencia')->sum('total')) }}</span></p>
            </div>
        </div>

        
        @if ($shift->status == 'closed')

            <hr class="border-gray-700 my-6">
            <div class="space-y-1 text-gray-400">
                <p>Total Caja: <span class="text-gray-200 font-semibold">$ {{ number_format($shift->closing_amount) }}</span></p>
                <p>Total Gastos: <span class="text-gray-200 font-semibold">$ {{ number_format($shift->total_expenses) }}</span></p>
                <div class="pt-2">
                    <span class="font-semibold text-gray-300 text-lg">Cuadre:</span>
                    <span class="text-blue-400 font-bold text-lg">
                        $ {{number_format(($facturas->where('payment_method', 'Efectivo')->sum('total')+$shift->total_expenses)-$shift->closing_amount)}}
                    </span>
                </div>
            </div>

            {{-- Tabla pequeña de facturas --}}
            <hr class="border-gray-700 my-6">
            <h3>Ventas</h3>
            <div class="max-h-60 overflow-y-auto border rounded">
                <table class="w-full text-sm">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="p-2">Hora</th>
                            <th class="p-2">Método</th>
                            <th class="p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facturas as $f)
                            <tr class="border-b dark:border-gray-700">
                                <td class="p-2">{{ $f->created_at->format('h:i A') }}</td>
                                <td class="p-2">{{ $f->payment_method }}</td>
                                <td class="p-2">$ {{ number_format($f->total) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr class="border-gray-700 my-6">
            <h3>Gastos</h3>
            <div class="max-h-60 overflow-y-auto border rounded">
                <table class="w-full text-sm">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th>Descripción</th>
                            <th>Valor</th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $exp)
                            <tr class="border-b dark:border-gray-700">
                                <td class="p-2">{{ $exp->description }}</td>
                                <td class="p-2">${{ number_format($exp->price, 0) }}</td>
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


        @endif

        {{-- Botones --}}
        <div class="flex justify-end gap-3 mt-6">
            <button class="px-5 py-2 rounded-lg bg-gray-600 text-gray-200 hover:bg-gray-500 transition"
                    wire:click="$set('showReporte', false)">
                Cerrar
            </button>

            @if ($shift->status == 'open')
            <button class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-500 transition shadow-md"
                    onclick="window.print()">
                Imprimir
            </button>
            @endif
        </div>

        </div>

    </div>
</div>
@endif
