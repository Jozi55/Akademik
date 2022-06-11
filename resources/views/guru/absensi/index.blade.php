@extends('template.home')
@section('heading', 'Data Absensi')
@section('page')
  <li class="breadcrumb-item active">Data Absensi</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        </div>

        <!-- /.card-header -->
        <div class="card-body">
   
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>No</th>
                      <th>Kelas</th>
                      <th>Mapel</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($pembagian as $item)
              <tbody>
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{$item->kelas->kelas}}</td>
                        <td>{{$item->mapel->mapel}}</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm" href="{{route('absensi-tambah',$item->id)}}">
                                <i class="nav-icon fas fa-folder-plus"></i> &nbsp;Input
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{route('absensi-view',$item->id)}}">
                                <i class="far fa-eye nav-icon"></i> &nbsp;view
                            </a>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ModalEdit{{$item->id}}" >
                                <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                            </button>
                        </td>
                    </tr>
              </tbody>
              @endforeach
            </table>
          </div>
    </div>
</div>

@foreach ($pembagian as $item)
<div class="modal fade ModalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <form method="get" action="{{route('absensi-edit',$item->id)}}">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="p">Pertemuan</label>
                                <input type="number" name="pertemuan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <button class="form-control btn-primary">Edit</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
@endforeach

@endsection
@section('script')
    <script>
        $("#AbsenSiswa").addClass("active");
    </script>
@endsection