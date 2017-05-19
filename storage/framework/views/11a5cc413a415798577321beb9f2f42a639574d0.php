<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords', 'keywords'); ?>" />
    <title><?php echo e(config('setting.title')); ?> <?php echo $__env->yieldContent('title', '欢迎您'); ?></title>

    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>" />

    <script>
        window.Laravel = '<?php echo json_encode(['csrfToken' => csrf_token()]); ?>'
    </script>
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>

<div id="app">
    ...
</div>


<script src="<?php echo e(mix('js/app.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
