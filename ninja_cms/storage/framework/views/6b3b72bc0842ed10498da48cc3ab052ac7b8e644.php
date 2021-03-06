<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Shipment</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Shipment</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Shipment</h3>  <a href="<?php echo e(url('/shipment/create')); ?>"><button type="button" style="margin-bottom: 10px;" class="btn btn-success">Add New Shipment</button></a></div>
                <div class="panel-body">
                    <div class="responsive-table">

                        <div class="flash-message">
                            <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(Session::has('alert-' . $msg)): ?>

                                    <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">                        
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>From Zone</th>
                                    <th>To Zone</th>
                                    <th>Price</th>
                                    <th>SLA</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Modified By</th>
                                    <th>Modified Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $data_shipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>    
                                    <td><?php echo e($no++); ?></td>
                                    <td><?php echo e($data->from_zone); ?></td>
                                    <td><?php echo e($data->to_zone); ?></td>
                                    <td><?php echo e(number_format($data->price)); ?></td>
                                    <td><?php echo e($data->sla); ?></td>
                                    <td><?php echo e($data->is_active=='1' ? 'Active':'Inactive'); ?></td>
                                    <td><?php echo e($data->created_by); ?></td>
                                    <td><?php echo e($data->created_at); ?></td>
                                    <td><?php echo e($data->updated_by); ?></td>
                                    <td><?php echo e($data->updated_at); ?></td>
                                    <td>
                                        <a href="<?php echo e(url('/shipment/'.$data->id.'/edit')); ?>"><button type="button" style="margin-bottom: 5px;" class="btn btn-warning">Edit</button></a>
                                        <form method="POST" action="<?php echo e(url('/shipment/'.$data->id.'/delete')); ?>">
                                            <!-- csrf perlu ditambahakan di setiap post -->
                                            <?php echo e(csrf_field()); ?>

                                            <input class="btn btn-danger" type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure want to delete caption zone <?php echo e($data->from_zone); ?>-<?php echo e($data->to_zone); ?>?');"> 
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cmsnew', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/ninja_cms_new/resources/views/pages/cms/shipment/index.blade.php */ ?>