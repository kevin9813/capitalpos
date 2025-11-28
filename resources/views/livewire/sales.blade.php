<div class="p-6 bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    
    {{-- Tabla --}}
    <div class="bg-white dark:bg-gray-800 dark:text-gray-200 rounded-2xl shadow overflow-hidden border border-gray-200 dark:border-gray-700">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="p-3 text-left">Usuario</th>
                    <th class="p-3 text-left">F. Apertura</th>
                    <th class="p-3 text-left">F. Cierre</th>
                    <th class="p-3 text-left">Estado Turno</th>
                    <th class="p-3 text-left">T. Ventas</th>
                    <th class="p-3 text-left">T. Gastos</th>
                    <th class="p-3 text-left"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cashShifts as $cashShift)
                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                        <td class="p-3">{{ $cashShift->user->name }}</td>
                        <td class="p-3">{{ $cashShift->opened_at->format('d/m/Y h:i A') }}</td>
                        <td class="p-3">{{ $cashShift->closed_at ? $cashShift->closed_at->format('d/m/Y h:i A') : '---' }}</td>
                        <td class="p-3">{{ ($cashShift->status == "open") ? "Abierto" : "Cerrado" }}</td>
                        <td class="p-3">$ {{ number_format($cashShift->total_sales) }}</td>
                        <td class="p-3">$ {{ number_format($cashShift->total_expenses) }}</td>
                        <td>
                            @if ($cashShift->status != "open")
                            <button wire:click="viewCashShift({{ $cashShift->id }})"  class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">
                            No hay Turnos registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @includeWhen($showReporte, 'livewire.reports.reporte-turno')

</div>
