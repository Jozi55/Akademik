@extends('template.home')
@section('heading', 'Data Tahun Ajaran')
@section('page')
  <li class="breadcrumb-item active">Data Tahun Pelajaran</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".ModalBesar">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Tahun Pelajaran
                </button>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body  table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>No.</th>
                      <th>Tahun Ajaran</th>
                      <th>Semester</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($tahun as $item)
              <tbody>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{$item->tahun}}</td>
                  <td>{{$item->semester}}</td>
                  <td class="text-center">
                      <button class="btn btn-primary  btn-sm" data-toggle="modal" data-target=".ModalEdit{{$item->id}}">
                        <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                    </button>
                  </td>
                </tbody>
                @endforeach
            </table>
          </div>
    </div>
</div>

<!-- Extra large modal -->
<div class="modal fade  ModalBesar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Tahun Pelajaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('simpan')}}" method="post">
            @csrf
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Tahun Ajaran</label>
                        <input type="text" id="tahun" name="tahun" class="form-control form1" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select id="semester" name="semester" class="form-control form1" required>
                            <option value="I / Ganjil">I/Ganjil</option>
                            <option value="II / Genap">II/Genap</option>
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
          </form>
      </div>
      </div>
    </div>
  </div>

<!-- large modal edit-->
@foreach ($tahun as $item)
    
<div class="modal fade  ModalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Edit Tahun Pelajaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('update-tahun',$item->id)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Tahun Ajaran</label>
                        <input type="text" id="tahun" name="tahun" class="form-control form1" value="{{$item->tahun}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select id="semester" name="semester" class="form-control form1">
                            <option value="{{$item->semester}}">{{$item->semester}}</option>
                            <option value="I/Ganjil">I/Ganjil</option>
                            <option value="II/Genap">II/Genap</option>
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
          </form>
      </div>
      </div>
    </div>
  </div>
  @endforeach

@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataTahun").addClass("active");
    </script>
@endsection