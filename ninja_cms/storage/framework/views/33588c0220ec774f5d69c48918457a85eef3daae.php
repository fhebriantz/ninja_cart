<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Provinces</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Provinces <span class="fa-angle-right fa"></span> Create</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Provinces</h3></div>
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
                    	<form method="POST" action="<?php echo e(url('/province/create')); ?>">
						<?php echo e(csrf_field()); ?>

	                        <table class="table">  
                                <tr>
                                    <td>Province Name <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="name" placeholder="Province name" value="<?php echo e(old('province_name')); ?>" style="width: 100%"></td>
                                </tr>   
                                <tr>
                                    <td>Status <em style="color:red">*</em></td>
                                    <td>
                                        <select name="status"  class="form-control" style="width: 100%">
                                            <option value="">-- Choose Status --</option>
                                            <option value="1" <?php echo e((old('status') == '1' ? 'selected':'')); ?>>Active</option>
                                            <option value="0" <?php echo e((old('status') == '0' ? 'selected':'')); ?>>Inactive</option>
                                        </select>
                                    </td>
                                </tr> 

								<tr>
									<td></td>
									<td>
                                        <input class="btn btn-info" name="submit" value="submit" type="submit">
                                        <a class="btn btn-danger" href="<?php echo e(url('/province')); ?>"  style="text-decoration: none;">Back</a>
                                    </td>
								</tr>
	                        </table>
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
<?php /* /var/www/html/ninja_cms_new/resources/views/pages/cms/province/create.blade.php */ ?>