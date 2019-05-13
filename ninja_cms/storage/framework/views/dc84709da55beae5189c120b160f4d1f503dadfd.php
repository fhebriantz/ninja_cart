<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
  <!-- start: Css -->
  <?php echo $__env->make('include/head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- end: Css -->
  <?php echo $__env->yieldContent('header'); ?>
</head>

<body id="mimin" class="dashboard">

      <!-- start: Header -->
      <?php echo $__env->make('include/nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
          <!-- start:Left Menu -->
          <?php echo $__env->make('include/left_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
          <!-- end: Left Menu -->
          <!-- start: Content -->
          <?php echo $__env->yieldContent('content'); ?>
          <!-- end: content -->

          <!-- start: right menu -->
          <!-- end: right menu -->
      </div>

      <!-- start: Mobile -->
      <?php echo $__env->make('include/mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- end: Mobile -->

<!-- start: Javascript -->
<?php echo $__env->make('include/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /* C:\xampp\htdocs\ninja_cart\ninja_cms\resources\views/layouts/cmsnew.blade.php */ ?>