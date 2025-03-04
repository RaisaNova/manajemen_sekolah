        
<?php $__env->startSection('content'); ?>

          
                
             <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Dashboard</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Dashboard</h2>
                </div>
                <!-- END PAGE TITLE -->  
                    
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                <!-- END PAGE CONTENT WRAPPER -->                                    
                </div>         
                <?php $__env->stopSection(); ?> 
                
                <?php $__env->startSection('script'); ?>
                <script>type="text/javascript" src"<?php echo e(asset('js/demo_tables.js')); ?>"</script>
                <?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\project11\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>