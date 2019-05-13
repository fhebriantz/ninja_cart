<?php $__env->startSection('content'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Villages</h3>
                <p class="animated fadeInDown">CMS <span class="fa-angle-right fa"></span> Villages <span class="fa-angle-right fa"></span> Create</p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading"><h3>Data Villages</h3></div>
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
                    	<form method="POST" action="<?php echo e(url('/village/create')); ?>">
						<?php echo e(csrf_field()); ?>

	                        <table class="table">  
                                <tr>
                                    <td>District Name <em style="color:red">*</em></td>
                                    <td>
                                        <!-- <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="district_id" style="width: 100%">
                                            <option value="">-- Choose District --</option>
                                            <?php $__currentLoopData = $list_district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($list->id); ?>" <?php echo e((old('district_id') == $list->id ? 'selected':'')); ?> ><?php echo e($list->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select> -->
                                        <select class="itemName form-control selectpicker" style="width:100%;" id="district_id" name="district_id"></select>
                                    </td>
                                </tr>       
                                <tr>
                                    <td>Village Name <em style="color:red">*</em></td>
                                    <td><input type="text"  class="form-control" name="name" placeholder="Village Name" value="<?php echo e(old('name')); ?>" style="width: 100%"></td>
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
                                <!--<tr>
                                    <td>Description</td>
                                    <td><textarea id="summernote" name="desc"><?php echo e(old('desc')); ?></textarea></td>
                                </tr>-->

								<tr>
									<td></td>
									<td>
                                        <input class="btn btn-info" name="submit" value="Submit" type="submit">
                                        <a class="btn btn-danger" href="<?php echo e(url('/village')); ?>" style="text-decoration: none;">Back</a>
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
<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style>
.select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 34px !important;}
.select2-container .select2-selection--single {height: 34px !important;font-size:14px !important}
.select2-container--default .select2-selection--single .select2-selection__arrow {height: 34px !important;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();

        // const districtOldValue = '<?php echo e(old('district_id')); ?>';
        // if(districtOldValue !== '') { //alert(districtOldValue);
        //     // $('#district_id').val(districtOldValue);
        //     // $('#district_id').select2('data', {id: districtOldValue, text: 'res_data.primary_email'});
        //     // $("select").val(districtOldValue);
        //     // autocompleteInput.select2('data', {id:districtOldValue, text:'ENABLED_FROM_JS'});
        //     $(".itemName").select2(districtOldValue,districtOldValue);
        // }

//         $("#district_id").select2("trigger", "select", {
//     data: { id: districtOldValue }
// });
    });
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $('.itemName').select2({
        placeholder: '-- Choose District --',
        ajax: 
        {
            url: "<?php echo e(url('village/list_ajax')); ?>",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                                return {
                                    results:  $.map(data, function (item) {
                                        return {
                                            text: item.name,
                                            id: item.id
                                        }
                                    })
                                };
                            },
            cache: true
        }
    });

    $('.itemName').select2('data', {id: '1101010', text: 'TEUPAH'});

    $(document).ready(function() {
        const districtOldValue = '<?php echo e(old('district_id')); ?>';
        if(districtOldValue !== '') { //alert(districtOldValue);
        //     // $('#district_id').val(districtOldValue);
        //     // $('#district_id').select2('data', {id: districtOldValue, text: 'res_data.primary_email'});
        //     // $("select").val(districtOldValue);
        //     // autocompleteInput.select2('data', {id:districtOldValue, text:'ENABLED_FROM_JS'});
        //     $(".itemName").select2('1101010','TEUPAH');
        // }

//         $("#district_id").select2("trigger", "select", {
//     data: { id: districtOldValue }
        $("#district_id option").remove();

        $.ajax({
             type: "GET",
             url: "<?php echo e(url('village/init_list_ajax')); ?>",
             data: "old_val=" + districtOldValue,
             success: function(response){
                 $("#district_id").append("<option value='" + districtOldValue + "'>" + response + "</option>");
             }
        });

        
};
    });
    // var test = $('#district_id');
    // test.on("select2:select", function(event) {
    //     var value = $(event.currentTarget).find("option:selected").val();
    //     console.log(value);
    // });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cmsnew', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* C:\xampp\htdocs\ninja_cms_new\resources\views/pages/cms/village/create.blade.php */ ?>