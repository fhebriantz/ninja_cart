<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Coupon</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Coupon <span class="fa-angle-right fa"></span> Edit</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Coupon</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    	<form method="POST" action="<?php echo e(url('/coupon/'.$data_coupon->id.'/edit')); ?>">
						<?php echo e(csrf_field()); ?>

	                        <table class="table">     
                                <tr>
                                    <td>Coupon Code <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="coupon_code" placeholder="CODE" value="<?php echo e($data_coupon->coupon_code); ?>" style="width: 100%" readonly=""></td>
                                </tr>    
                                <tr>
                                    <td>Coupon Name <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="coupon_name" placeholder="Coupon Name" value="<?php echo e($data_coupon->coupon_name); ?>" style="width: 100%"></td>
                                </tr>   
                                <tr>
                                    <td>Description</td>
                                    <td><textarea class="form-control" name="description" placeholder="Description" style="width: 100%"><?php echo e($data_coupon->description); ?></textarea></td>
                                </tr> 
                                <tr>
                                    <td>Quota <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="quota" placeholder="0" value="<?php echo e($data_coupon->quota); ?>" style="width: 100%"></td>
                                </tr>  
                                <tr>
                                    <td>Nominal <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="nominal" placeholder="0" value="<?php echo e($data_coupon->nominal); ?>" style="width: 100%"></td>
                                </tr>              
                                <tr>
                                    <td>Start Date</td>
                                    <td>
                                        <div class='input-group date datetimepicker1'>
                                            <input type='text' class="form-control" name="start_date" placeholder="YYYY-MM-DD hh:mm:ss"  value="<?php echo e($data_coupon->start_date); ?>" >
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>

                                </tr>            
                                <tr>
                                    <td>End Date</td>
                                    <td>
                                        <div class='input-group date datetimepicker1'>
                                            <input type='text' class="form-control" name="end_date" placeholder="YYYY-MM-DD hh:mm:ss"  value="<?php echo e($data_coupon->end_date); ?>" >
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status <em style="color:red">*</em></td>
                                    <td>
                                        <select name="status"  class="form-control" style="width: 100%">
                                            <option value="1" <?php echo e(($data_coupon->is_active=='1' ? 'Selected':'')); ?> >Active</option>
                                            <option value="0" <?php echo e(($data_coupon->is_active=='0' ? 'Selected':'')); ?> >Inactive</option>
                                        </select>
                                    </td>
                                </tr> 

								<tr>
									<td></td>
									<td>
										<input class="btn btn-info" name="submit" value="Submit" type="submit">
										<a class="btn btn-danger" href="<?php echo e(url('/coupon')); ?>"  style="text-decoration: none;">Back</a>
									</td>
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

<?php $__env->startSection('header'); ?>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cmsnew', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* C:\xampp\htdocs\ninja_cms_new\resources\views/pages/cms/coupon/edit.blade.php */ ?>