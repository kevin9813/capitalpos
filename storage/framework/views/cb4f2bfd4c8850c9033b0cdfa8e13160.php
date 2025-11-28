<div class="p-6 bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    
    
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
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $cashShifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cashShift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                        <td class="p-3"><?php echo e($cashShift->user->name); ?></td>
                        <td class="p-3"><?php echo e($cashShift->opened_at->format('d/m/Y h:i A')); ?></td>
                        <td class="p-3"><?php echo e($cashShift->closed_at ? $cashShift->closed_at->format('d/m/Y h:i A') : '---'); ?></td>
                        <td class="p-3"><?php echo e(($cashShift->status == "open") ? "Abierto" : "Cerrado"); ?></td>
                        <td class="p-3">$ <?php echo e(number_format($cashShift->total_sales)); ?></td>
                        <td class="p-3">$ <?php echo e(number_format($cashShift->total_expenses)); ?></td>
                        <td>
                            <!--[if BLOCK]><![endif]--><?php if($cashShift->status != "open"): ?>
                            <button wire:click="viewCashShift(<?php echo e($cashShift->id); ?>)"  class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">
                            No hay Turnos registrados
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <?php echo $__env->renderWhen($showReporte, 'livewire.reports.reporte-turno', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>

</div>
<?php /**PATH /var/www/html/resources/views/livewire/sales.blade.php ENDPATH**/ ?>