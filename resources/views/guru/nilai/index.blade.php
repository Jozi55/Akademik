@extends('template.home')
@section('heading', 'List Kelas')
@section('page')
  <li class="breadcrumb-item active">List Kelas</li>
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
                      <th>Kelas</th>
                      <th>Mapel</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($pembagian as $item)
              <tbody>
                <td class="text-center">{{$loop->iteration}}</td>
                <td>{{$item->kelas->kelas}}</td>
                <td>{{$item->mapel->mapel}}</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{route('guru-nilai',$item->id)}}">
                        <i class="nav-icon far fa-eye"></i> &nbsp; View
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
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#NA").addClass("active");
    </script>
@endsection