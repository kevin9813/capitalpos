<div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-md">

    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200 text-center">
        Configuración de la Compañía
    </h2>

    
    <!--[if BLOCK]><![endif]--><?php if($logoPreview): ?>
        <div class="flex justify-center mb-6">
            <img src="<?php echo e($logoPreview); ?>" class="h-24 w-24 object-contain rounded-md border border-gray-200 dark:border-gray-700">
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <form wire:submit.prevent="save" class="space-y-5">

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                <input type="text" wire:model="name"
                    class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIT</label>
                <input type="text" wire:model="nit"
                    class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['nit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slogan</label>
            <textarea wire:model="slogan" rows="2"
                class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500"></textarea>
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['slogan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" wire:model="email"
                class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500">
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Logo</label>
                <input type="file" wire:model="logo"
                    class="mt-1 block w-full text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg p-2 bg-white dark:bg-gray-800 transition">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                <select wire:model="status" disabled
                    class="w-full border rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1">Activo</option>
                </select>
            </div>
        </div>

        
        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-semibold rounded-lg transition">
                <i class="fa-solid fa-floppy-disk"></i> Guardar
            </button>
        </div>

    </form>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/settings.blade.php ENDPATH**/ ?>