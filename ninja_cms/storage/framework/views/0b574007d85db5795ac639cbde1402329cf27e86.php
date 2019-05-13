<?php $__env->startSection('header'); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<style>
  .rc-anchor-normal{
  width: 278px !important
}
.rc-anchor-normal .rc-anchor-checkbox-label{
  width: 100px !important
}
.rc-anchor-normal .rc-anchor-content{
  width: 155px !important
}
.rc-anchor-normal .rc-anchor-pt{
  margin: 2px 64px 0 0 !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">

        <form class="form-signin" method="POST" action="<?php echo e(url('login')); ?>">
          <?php echo e(csrf_field()); ?>

          <div class="panel periodic-login">
              <div class="panel-body text-center">
                  <h1 class="atomic-symbol">CMS</h1>
                  <p class="atomic-mass">FIBER CREME</p>
                  <!--<p class="element-name">Made In Indonesia</p>-->

                  <i class="icons icon-arrow-down"></i>

                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="text" class="form-text" name="username" required placeholder="username">
                    <span class="bar"></span>
                    <label></label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" name="password" required placeholder="Password">
                    <span class="bar"></span>
                    <p style="padding-top: 10px; color: #fff"><strong><?php echo e(session()->get('message')); ?></strong></p>
                  </div>
                    <!--<div class="g-recaptcha" data-sitekey="6LeG138UAAAAAAEKQVzQJsevj9a9Fly_DPum6ayO"></div>
                    <p style="padding-top: 10px; color: #fff"><strong><?php echo e(session('captcha')); ?></strong></p>-->
                    <input type="submit" name="login" class="btn col-md-12" value="LOGIN"/>
              </div>
          </div>
        </form>

      </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cmslogin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* C:\xampp\htdocs\ninja_cms\resources\views/pages/user/login.blade.php */ ?>