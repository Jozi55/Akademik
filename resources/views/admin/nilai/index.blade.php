@extends('template.home')
@section('heading', 'Data Nilai')
@section('page')
  <li class="breadcrumb-item active">Data Nilai</li>
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
            <table id="example3" class="table table-bordered table-hover text-center">
              <thead>
                  <tr>
                      <th>Kelas</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              <tbody >
                @foreach ($kelas as $item)
                  <tr>
                    <td>{{$item->kelas}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{route('siswa-nilai',$item->id)}}">
                            <i class="far fa-eye nav-icon"></i> &nbsp;view
                        </a>  
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $("#liMasterData").addClass("menu-open");
        $("#AdminNilai").addClass("active");
    </script>
@endsection