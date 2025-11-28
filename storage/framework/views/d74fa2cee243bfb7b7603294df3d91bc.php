<div class="p-6 bg-gray-100 dark:bg-gray-900 transition-colors duration-300">

    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Productos</h1>

       
         <button wire:click="create" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow">
            <i class="fa-solid fa-plus"></i> Nuevo
        </button>
    </div>

    
    <!-- Modal -->
    <!--[if BLOCK]><![endif]--><?php if($showModal): ?>
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white text-black dark:bg-gray-900 dark:text-white rounded-xl shadow-lg w-full max-w-md p-6">

                <h2 class="text-xl font-semibold mb-4">
                    <?php echo e($ProductIdBeingEdited ? 'Editar Producto' : 'Crear Producto'); ?>

                </h2>
           
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Código</label>
                    <input type="text" wire:model="code"
                        class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                    <input type="text" wire:model="name"
                        class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Unidad</label>
                    <select wire:model="unit_type"
                        class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500">
                        <option value="kl">Kilo</option>
                        <option value="unidad">Unidad</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Precio</label>
                    <input type="number" wire:model="price" step="0.01"
                        class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Impuesto (%)</label>
                    <input type="number" wire:model="tax_percent" step="0.01"
                        class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                    <textarea wire:model="description"
                        class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="col-span-2 text-right">
                    <button wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-500 text-white rounded">
                        Cancelar
                    </button>
                    <button wire:click="save()"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-semibold rounded-lg transition">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->


    
    
    <div class="bg-white dark:bg-gray-800 dark:text-gray-200 rounded-2xl shadow overflow-hidden border border-gray-200 dark:border-gray-700">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="p-3 text-left">Código</th>
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Unidad</th>
                    <th class="p-3 text-left">Precio</th>
                    <th class="p-3 text-left">Impuesto</th>
                    <th class="p-3 text-left"></th>
                </tr>
            </thead>
            <tbody>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                        <td class="p-3"><?php echo e($p->code); ?></td>
                        <td class="p-3"><?php echo e($p->name); ?></td>
                        <td class="p-3"><?php echo e($p->unit_type); ?></td>
                        <td class="p-3">$<?php echo e(number_format($p->price, 2)); ?></td>
                        <td class="p-3"><?php echo e($p->tax_percent); ?>%</td>
                        <td>
                            <button 
                                wire:click="edit(<?php echo e($p->id); ?>)"
                                class="px-3 py-1 bg-yellow-500 text-white rounded">
                                <i class="fa-solid fa-file-pen"></i>
                            </button>

                            <button 
                                wire:click="askDelete(<?php echo e($p->id); ?>)"
                                class="px-3 py-1 bg-red-600 text-white rounded">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">
                            No hay productos registrados
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <!--[if BLOCK]><![endif]--><?php if($confirmingDeleteId): ?>
         <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-md p-6">
                <h2 class="text-xl font-semibold mb-4">Confirmar Eliminación</h2>
                <p>¿Está seguro de eliminar el producto?</p>

                <div class="flex justify-end mt-4 space-x-2">
                    <button wire:click="$set('confirmingDeleteId', null)"
                            class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancelar</button>
                    <button wire:click="deleteConfirmed(<?php echo e($confirmingDeleteId); ?>)"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Sí, eliminar</button>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</div>
<?php /**PATH /var/www/html/resources/views/livewire/products.blade.php ENDPATH**/ ?>