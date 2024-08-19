

<?php $__env->startSection('content'); ?>
    <style>
        body {
            background-color: #000000;
        }
    </style>
    <div class="w-100">
        <div class="imagen-principal w-100 v-100">
            <img class="w-100" src="<?php echo e(asset('images/imagen_principal.png')); ?>" alt="">

            <div class="text-img-principal">
                ENCUENTRA LO QUE NECESITES
            </div>
        </div>


        <div class="container">
            <div class="catalogo">
                <h1 class="novedades">NOVEDADES</h1>
                <div class="row align-items-center productos">
                    <?php $__currentLoopData = $productos->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 producto">
                            <div class="uni-producto" style="height: 300px;">
                                <a href="producto.html">
                                    <img src="<?php echo e(asset('images/productos/' . $producto->nombre_imagen . '.jpg')); ?>"
                                        alt="<?php echo e($producto->nombre_imagen); ?>" class="img-fluid h-100 w-100"
                                        style="object-fit: cover;">
                                </a>
                            </div>
                            <div class="text-product row">
                                <a class="nom-producto col-7 text-decoration-none"
                                    href="producto.html"><?php echo e($producto->nombre); ?></a>
                                <span class="col-5 text-end ">$ <?php echo e($producto->precio); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\NEW-CRUD-KOKOSHOP-UI\resources\views/home.blade.php ENDPATH**/ ?>