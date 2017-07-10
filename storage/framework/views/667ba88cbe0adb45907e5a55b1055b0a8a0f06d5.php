<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords', config('app.name')); ?>" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo e(config('app.name')); ?>-<?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('web/css/base.css')); ?>" />
    <?php echo $__env->yieldContent('css'); ?>
    <script type="text/javascript" src="<?php echo e(asset('web/js/jquery.min.js')); ?>"></script>
</head>

<body>
<?php echo $__env->yieldContent('content'); ?>

<script src="<?php echo e(asset('web/plugins/layer/layer.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>