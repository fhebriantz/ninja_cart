<!-- start: Javascript -->
<script src="<?php echo e(asset('asset/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/js/jquery.ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/js/bootstrap.min.js')); ?>"></script>



<!-- plugins -->
<script src="<?php echo e(asset('asset/js/plugins/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/js/plugins/jquery.datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/js/plugins/datatables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/js/plugins/jquery.nicescroll.js')); ?>"></script>


<!-- custom -->
<script src="<?php echo e(asset('asset/js/main.js?v=0.1')); ?>"></script>
<script src="<?php echo e(url('/js/ckeditor/ckeditor.js')); ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });
</script>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputgambar").change(function () {
        readURL(this);
    });

</script>
<!-- end: Javascript -->
<?php /* C:\xampp\htdocs\ninja_cms_new\resources\views/include/scripts.blade.php */ ?>