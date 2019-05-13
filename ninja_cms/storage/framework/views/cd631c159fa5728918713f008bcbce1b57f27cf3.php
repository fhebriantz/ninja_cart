<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Shipment</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Shipment <span class="fa-angle-right fa"></span> Create</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Shipment</h3></div>
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
                    	<form method="POST" action="<?php echo e(url('/shipment/create')); ?>" enctype="multipart/form-data">
						<?php echo e(csrf_field()); ?>

	                        <table class="table">  
                                <tr>
                                    <td>Zona <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="zona" placeholder="Code of Zona" value="<?php echo e(old('zona')); ?>" style="width: 100%"></td>
                                </tr>       
                                <!--<tr>
                                    <td>Price <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="price" placeholder="0" value="<?php echo e(!empty(old('price')) ? number_format(old('price')):''); ?>" style="width: 100%"></td>
                                </tr>-->   
                                <tr>
                                    <td>Price <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="price" placeholder="0" value="<?php echo e(old('price')); ?>" style="width: 100%"></td>
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
                                        <input class="btn btn-info" name="submit" value="Submit" type="submit">
                                        <a class="btn btn-danger" href="<?php echo e(url('/shipment')); ?>"  style="text-decoration: none;">Back</a>
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
<link href="<?php echo e(asset('css/fileinput.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<link href="<?php echo e(asset('themes/explorer-fas/theme.css')); ?>" media="all" rel="stylesheet" type="text/css"/>
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
<?php /* C:\xampp\htdocs\ninja_cms_new\resources\views/pages/cms/shipment/create.blade.php */ ?>