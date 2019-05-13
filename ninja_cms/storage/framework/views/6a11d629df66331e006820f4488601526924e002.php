<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Transaction</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Transaction</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Transaction</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">                        
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Order</th>
                                    <th>Customer Name</th>
                                    <th>Date Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $data_transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>    
                                    <td><?php echo e($no++); ?></td>
                                    <td><?php echo e($data->id_order); ?></td>
                                    <td><?php echo e($data->fullname); ?></td>
                                    <td><?php echo e($data->date_order); ?></td>
                                    <td>
                                        <a href="<?php echo e(url('/transaction/'.$data->id_order.'/view')); ?>"><button type="button" class="btn btn-primary">View</button></a>
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
<?php /* C:\xampp\htdocs\ninja_cms_new\resources\views/pages/cms/transaction/index.blade.php */ ?>