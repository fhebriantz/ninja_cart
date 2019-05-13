<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
  <?php echo $__env->make('include/head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- end: Css -->
  <?php echo $__env->yieldContent('header'); ?>
</head>

 <body id="mimin" class="dashboard form-signin-wrapper">

          <?php echo $__env->yieldContent('content'); ?>
          <!-- end: content -->

<?php echo $__env->make('include/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /* C:\xampp\htdocs\ninja_cart\ninja_cms\resources\views/layouts/cmslogin.blade.php */ ?>