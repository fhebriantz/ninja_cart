<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Customer</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Customer <span class="fa-angle-right fa"></span> View</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Customer</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table class="table">         
                            <tr>
                                <td>Customer Name</td>
                                <td><input type="text" class="form-control"  name="fullname"  value="<?php echo e($data_customer->fullname); ?>" style="width: 100%" readonly></td>
                            </tr>           
                            <tr>
                                <td>Email</td>
                                <td><input type="text" class="form-control"  name="email"  value="<?php echo e($data_customer->email); ?>" style="width: 100%" readonly></td>
                            </tr>           
                            <tr>
                                <td>Phone Number</td>
                                <td><input type="text" class="form-control"  name="phone_number"  value="<?php echo e($data_customer->phone_number); ?>" style="width: 100%" readonly></td>
                            </tr>          
                            <tr>
                                <td>Gender</td>
                                <td><input type="text" class="form-control"  name="gender" value="<?php echo e($data_customer->gender); ?>" style="width: 100%" readonly></td>
                            </tr>      
                            <tr>
                                <td>Address</td>
                                <td><textarea class="form-control"  name="address" style="width: 100%" readonly><?php echo e($data_customer->address); ?></textarea></td>
                            </tr>          
                            <tr>
                                <td>Country</td>
                                <td><input type="text" class="form-control"  name="country" value="<?php echo e($data_customer->country); ?>" style="width: 100%" readonly></td>
                            </tr>              
                            <tr>
                                <td>Province</td>
                                <td><input type="text" class="form-control"  name="province" value="<?php echo e($data_customer->province); ?>" style="width: 100%" readonly></td>
                            </tr>     
                            <tr>
                                <td>Regency</td>
                                <td><input type="text" class="form-control"  name="regency" value="<?php echo e($data_customer->regency); ?>" style="width: 100%" readonly></td>
                            </tr>          
                            <tr>
                                <td>District</td>
                                <td><input type="text" class="form-control"  name="district" value="<?php echo e($data_customer->district); ?>" style="width: 100%" readonly></td>
                            </tr>              
                            <tr>
                                <td>Village</td>
                                <td><input type="text" class="form-control"  name="village" value="<?php echo e($data_customer->village); ?>" style="width: 100%" readonly></td>
                            </tr>   
                            <tr>
                                <td>Zipcode</td>
                                <td><input type="text" class="form-control"  name="zipcode" value="<?php echo e($data_customer->zipcode); ?>" style="width: 100%" readonly></td>
                            </tr>                    
                            <tr>
                                <td>Created Date</td>
                                <td><input type="text"  class="form-control" name="created_at" value="<?php echo e($data_customer->created_at); ?>" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td>Created By</td>
                                <td><input type="text"  class="form-control" name="created_by" value="<?php echo e($data_customer->created_by); ?>" style="width: 100%" readonly></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <a class="btn btn-danger" href="<?php echo e(url('/customer')); ?>"  style="text-decoration: none;">Back</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cmsnew', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/ninja_cms_new/resources/views/pages/cms/customer/view.blade.php */ ?>