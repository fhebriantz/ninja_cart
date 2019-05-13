<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Villages</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Villages</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Villages</h3>  <a href="<?php echo e(url('/village/create')); ?>"><button type="button" style="margin-bottom: 10px;" class="btn btn-success">Add New Village</button></a></div>
                <div class="panel-body">
                    <div class="responsive-table">

                        <div class="flash-message">
                            <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(Session::has('alert-' . $msg)): ?>

                                    <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        <table id="datatables-example2" class="table table-striped table-bordered" width="100%" cellspacing="0">                        
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>District Name</th>
                                    <th>Village Name</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Modified By</th>
                                    <th>Modified Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" rel="stylesheet"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#datatables-example2').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: 'village/json',
            columns: [
                { data: null,sortable: false},
                { data: 'district_name', name: 'district_name' },
                { data: 'name', name: 'name' },
                { 
                	data: 'is_active', 
                	render: function(data, type, row, meta) {
                		if(data=='1') return 'Active';
                		else return 'Inactive';
                	}
                },
                { data: 'created_by', name: 'created_by' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_by', name: 'updated_by' },
                { data: 'updated_at', name: 'updated_at' },
                { 
                    data: 'id', 
                    render: function(data, type, row, meta) {
                        var custom_location = '<?php echo e(url("/village/")); ?>';

                        return '<a href="' + custom_location + '/' + data + '/edit"><button type="button" class="btn btn-warning" style="margin-bottom: 5px">Edit</button></a><form method="POST" action="' + custom_location + '/' + data + '/delete"><?php echo e(csrf_field()); ?><input class="btn btn-danger" type="submit" name="delete" value="Delete" onclick="return confirm(\'Are you sure want to delete caption ' + row.name + '?\');"><input type="hidden" name="_method" value="DELETE"></form>';
                    }
                }
            ],
	        // "fnCreatedRow": function (row, data, index) {
	        //     $('td', row).eq(0).html(index + 1);
	        // }
        });

        table.on('draw.dt', function () {
		    var info = table.page.info();
		    table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
		        cell.innerHTML = i + 1 + info.start;
		    });
		});
    } );
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cmsnew', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* C:\xampp\htdocs\ninja_cms_new\resources\views/pages/cms/village/index.blade.php */ ?>