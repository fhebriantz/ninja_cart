<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Shipment</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Shipment <span class="fa-angle-right fa"></span> Edit</p>
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
                    	<form method="POST" action="<?php echo e(url('/shipment/'.$data_shipment->id.'/edit')); ?>">
						<?php echo e(csrf_field()); ?>

	                        <table class="table">     
                                <tr>
                                    <td>Shipment Type</td>
                                    <td><input type="text"  class="form-control" name="shipment_type" placeholder="Shipment Type" value="<?php echo e($data_shipment->shipment_type); ?>" style="width: 100%" readonly=""></td>
                                </tr>  
                                <tr>
                                    <td>Zona <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="zona" placeholder="Code of Zona" value="<?php echo e($data_shipment->zona); ?>" style="width: 100%"></td>
                                </tr>    
                                <tr>
                                    <td>Price <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="price" placeholder="0" value="<?php echo e($data_shipment->price); ?>" style="width: 100%"></td>
                                </tr>   

								<tr>
									<td></td>
									<td>
										<input class="btn btn-info" name="submit" value="Submit" type="submit">
										<a class="btn btn-danger" href="<?php echo e(url('/shipment')); ?>"  style="text-decoration: none;">Back</a>
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
<?php /* C:\xampp\htdocs\ninja_cms_new\resources\views/pages/cms/shipment/edit.blade.php */ ?>