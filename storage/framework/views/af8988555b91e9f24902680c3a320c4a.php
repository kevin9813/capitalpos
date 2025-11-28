<div style="font-family: monospace; font-size: 13px; width: 260px;">

    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold tracking-wide"><i class="fa-solid fa-file-zipper"></i> Factura #<?php echo e(str_pad($sale_id, 8, '0', STR_PAD_LEFT)); ?></h1>
        <h2 class="text-lg font-semibold mt-1"><?php echo e(session('companyName')); ?></h2>
        <p class="text-sm text-gray-400">NIT: <?php echo e(session('companyNit')); ?></p>
         <p class="text-sm text-gray-400"><?php echo e(date('d/m/Y h:i A')); ?></p>
    </div>
    <hr>

    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <strong><?php echo e($item['name']); ?></strong> <br>

            <?php echo e($item['unit_type'] == 'kl' ? $item['weight'] : $item['quantity']); ?>

            × $<?php echo e(number_format($item['price'])); ?>


            <span style="float:right;">
                $<?php echo e(number_format($item['subtotal'])); ?>

            </span>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <hr>
    <strong>Total: $<?php echo e(number_format($total)); ?></strong><br>
    <strong>Método: <?php echo e($payment_method); ?></strong>

    <hr>
    <p style="text-align:center;">¡Gracias por su compra!</p>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/invoices/ticket.blade.php ENDPATH**/ ?>