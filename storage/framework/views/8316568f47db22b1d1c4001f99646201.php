<div>
    <h2 class="text-2xl font-bold mb-4">Dasboard</h2>


    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-2">Productos en stock</h3>
            <p class="text-2xl font-bold text-red-700"><?php echo e($countProducts); ?></p>
        </div>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-2">Proveedores activos</h3>
            <p class="text-2xl font-bold text-red-700"><?php echo e($countsuppliers); ?></p>
        </div>
    </div>
</div>

<?php /**PATH /var/www/html/resources/views/livewire/dashboard.blade.php ENDPATH**/ ?>