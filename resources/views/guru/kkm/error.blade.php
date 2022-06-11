@extends('template.home')
@section('heading', 'Data KKM')
@section('page')
  <li class="breadcrumb-item active">Data KKM</li>
@endsection
@section('content')
<div class="col-md-12">
    <h3 style="text-align: center">Anda Bukan Wali Kelas</h3>
</div>

<!-- Extra large modal -->


<!-- large modal edit-->

@endsection
@section('script')
    <script>
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#KKM").addClass("active");
    </script>
@endsection