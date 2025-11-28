<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <script src="<?php echo e(asset('css/tailwind.css')); ?>"></script> 
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    
    <main class="flex items-center justify-center w-full h-full">
        <?php echo e($slot); ?>

    </main>
    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html><?php /**PATH /var/www/html/resources/views/layouts/blank.blade.php ENDPATH**/ ?>