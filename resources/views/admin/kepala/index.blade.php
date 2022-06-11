@extends('template.home')
@section('heading', 'Data Kepala Sekolah')
@section('page')
  <li class="breadcrumb-item active">Data Kepala Sekolah</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".ModalBesar">
                    <i class="nav-icon far fa-edit"></i> &nbsp; Tambah Data
                </button>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <form action="{{route('kepala-cari')}}" method="GET">
                <div class="col-md-2">
                    <label for="status" style="text-align: center">Status</label>
                    <select name="status" id="" class="form-control" onchange="this.form.submit();">
                        <option value="">-- Pilih Status --</option>
                        <option value="Menjabat">Menjabat</option>
                        <option value="Tidak Menjabat">Tidak Menjabat</option>
                    </select>  
                </div>  
            </form>
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>No.</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($kepsek as $item)
              <tbody>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{$item->nip}}</td>
                <td>{{$item->nama}}</td>
                <td class="text-center">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ModalEdit{{$item->id}}">
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
          <h4 class="modal-title">Tambah Data Kepala Sekolah</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('simpan-kepsek')}}" method="post">
            @csrf
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="number" id="nip" name="nip" class="form-control form1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="nama" class="form-control form1" required>
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
@foreach ($kepsek as $item)
    
<div class="modal fade  ModalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Edit Data Kepala Sekolah</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('update-kepsek',$item->id)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="number" id="nip" name="nip" class="form-control form1" value="{{$item->nip}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="nama" class="form-control form1" value="{{$item->nama}}">
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
        $("#DataKepala").addClass("active");
    </script>
@endsection