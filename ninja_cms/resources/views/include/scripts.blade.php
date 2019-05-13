<!-- start: Javascript -->
<script src="{{ asset('asset/js/jquery.min.js')}}"></script>
<script src="{{ asset('asset/js/jquery.ui.min.js')}}"></script>
<script src="{{ asset('asset/js/bootstrap.min.js')}}"></script>



<!-- plugins -->
<script src="{{ asset('asset/js/plugins/moment.min.js')}}"></script>
<script src="{{ asset('asset/js/plugins/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('asset/js/plugins/datatables.bootstrap.min.js')}}"></script>
<script src="{{ asset('asset/js/plugins/jquery.nicescroll.js')}}"></script>


<!-- custom -->
<script src="{{ asset('asset/js/main.js?v=0.1')}}"></script>
<script src="{{url('/js/ckeditor/ckeditor.js')}}"></script>
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