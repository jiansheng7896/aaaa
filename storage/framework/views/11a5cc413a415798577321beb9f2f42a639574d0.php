<?php $__env->startSection('title', '首页'); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="top-right links">
        <?php if(Auth::check()): ?>
            <a href="<?php echo e(url('/home')); ?>">Home</a>
            <a href="<?php echo e(url('/logout')); ?>">Logout</a>
        <?php else: ?>
            <a href="<?php echo e(url('/login')); ?>">Login</a>
            <a href="<?php echo e(url('/register')); ?>">Register</a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.common.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>