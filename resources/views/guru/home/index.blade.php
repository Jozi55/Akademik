@extends('template.home')
@section('heading', 'Dashboard Guru')
@section('page')
  <li class="breadcrumb-item active">Dashboard Guru</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <div class="text-center">
                <strong><h3>SISTEM INFORMASI AKADEMIK <br>SD NEGERI 3 DENCARIK</h3></strong>
                <img src="{{asset('dist/img/welcome-removebg-preview.png')}}" alt="" width="550px" height="300px">
            </div>
            
          </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $("#AdminHome").addClass("active");
    </script>
@endsection