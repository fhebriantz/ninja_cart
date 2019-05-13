<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Regencies</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Regencies</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Regencies</h3>  <a href="<?php echo e(url('/regency/create')); ?>"><button type="button" style="margin-bottom: 10px;" class="btn btn-success">Add New Regency</button></a></div>
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
                                    <th>Province Name</th>
                                    <th>Regency Name</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Modified By</th>
                                    <th>Modified Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $data_regency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>    
                                    <td><?php echo e($no++); ?></td>
                                    <td><?php echo e($data->province_name); ?></td>
                                    <td><?php echo e($data->name); ?></td>
                                    <td><?php echo e($data->is_active=='1' ? 'Active':'Inactive'); ?></td>
                                    <td><?php echo e($data->created_by); ?></td>
                                    <td><?php echo e($data->created_at); ?></td>
                                    <td><?php echo e($data->updated_by); ?></td>
                                    <td><?php echo e($data->updated_at); ?></td>
                                    <td>
                                        <a href="<?php echo e(url('/regency/'.$data->id.'/edit')); ?>"><button type="button" class="btn btn-warning" style="margin-bottom: 5px">Edit</button></a>
                                        <form method="POST" action="<?php echo e(url('/regency/'.$data->id.'/delete')); ?>">
                                            <!-- csrf perlu ditambahakan di setiap post -->
                                            <?php echo e(csrf_field()); ?>

                                            <input class="btn btn-danger" type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure want to delete caption <?php echo e($data->name); ?>?');"> 
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
<?php /* C:\xampp\htdocs\ninja_cms_new\resources\views/pages/cms/regency/index.blade.php */ ?>