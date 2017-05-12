<?php $__env->startSection('title', '首页'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <div class="flex-center position-ref full-height">
        
        <div class="top-right links">
            <?php if(Auth::check()): ?>
                <a href="<?php echo e(url('/')); ?>">Home</a>
                <a href="<?php echo e(url('/logout')); ?>">Logout</a>
            <?php else: ?>
                <a href="<?php echo e(url('/login')); ?>">Login</a>
                <a href="<?php echo e(url('/register')); ?>">Register</a>
                <a href="<?php echo e(url('/password/reset')); ?>">Reset</a>
            <?php endif; ?>
        </div>
        

        <div class="content">
            首页<?php echo e(!is_null(Auth::user()) ? Auth::user()->name : ''); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(function(){
            alert(1111);
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.common.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>