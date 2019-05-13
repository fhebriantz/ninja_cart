<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">User</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> User <span class="fa-angle-right fa"></span> Change Password</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Change Password</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <div class="flash-message">
                            <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(Session::has('alert-' . $msg)): ?>

                                    <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    	<form method="POST" action="<?php echo e(url('/user/password/'.$data_user->id.'/edit')); ?>">
						<?php echo e(csrf_field()); ?>

	                        <table class="table">
							<tr>
								<td>Fullname</td>
								<td> <input type="text" class="form-control" name="name" value="<?php echo e($data_user->fullname); ?>" style="width: 100%" readonly=""></td>
							</tr>
                            <tr>
                                <td>Username</td>
                                <td> <input type="text" class="form-control" name="username" value="<?php echo e($data_user->username); ?>" style="width: 100%" readonly=""></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td> <input type="password" class="form-control" name="password" placeholder="Password" value="" style="width: 100%"></td>
                            </tr>
                            <tr>
                                <td>Confirmation Password</td>
                                <td> <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" value="" style="width: 100%"></td>
                            </tr>
							<tr>
								<td></td>
								<td><input class="btn btn-info" name="submit" value="Submit" type="submit" ></td>
							</tr>
						</table>
                        <input type="hidden" name="_method" value="PUT">
	                    </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cmsnew', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/ninja_cms_new/resources/views/pages/cms/user/password.blade.php */ ?>