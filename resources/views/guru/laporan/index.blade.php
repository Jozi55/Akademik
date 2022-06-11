@extends('template.home')
@section('heading', 'Nama Siswa')
@section('page')
  <li class="breadcrumb-item active">Nama Siswa</li>
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
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>NO</th>
                      <th>Nama</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($siswa as $item)
              <tbody>
                <td class="text-center">{{$loop->iteration}}</td>
                <td>{{$item->nama}}</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{route('view-raport',$item->id)}}">
                        <i class="nav-icon far fa-eye"></i> &nbsp; View
                    </a>
                    <a class="btn btn-default btn-sm" href="{{route('cetak-raport',$item->id)}}" target="_blank">
                        <i class="nav-icon far fa-file-pdf"></i> &nbsp; Cetak Rapot
                    </a>
                </td>
              </tbody>
              @endforeach
            </table>
          </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $("#LA").addClass("active");
    </script>
@endsection