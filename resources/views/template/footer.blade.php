<footer class="main-footer">
            <center><strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> &diams; <a>SD Negeri 3 Dencarik</a>. </strong></center>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
]
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
]


<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- page script -->
<script>

    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true,
        });
        $('#example3').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true,
        });
    });


    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottomRight',
        showConfirmButton: false,
        timer: 3000
    });


    
</script>


@yield('script')

@if (count($errors)>0)
    @foreach ($errors->all() as $error)
        <script>
            toastr.error("{{ $error }}");
        </script>
    @endforeach
@endif
@if (Session::has('success'))
    <script>
        toastr.success("{{ Session('success') }}");
    </script>
@endif
@if (Session::has('warning'))
    <script>
        toastr.warning("{{ Session('warning') }}");
    </script>
@endif
@if (Session::has('info'))
    <script>
        toastr.info("{{ Session('info') }}");
    </script>
@endif
@if (Session::has('error'))
    <script>
        toastr.error("{{ Session('error') }}");
    </script>
@endif



</body>
</html>
