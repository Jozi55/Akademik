@extends('template.home')
@section('heading', 'Data List Mata Pelajaran')
@section('page')
  <li class="breadcrumb-item active">Data List Mata Pelajaran</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".ModalBesar">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Mata Pelajaran
                </button>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <form action="{{route('mapel-cari')}}" method="GET">
                <div class="row text-center">
                    <div class="col-md-5">
                        <label for="status">Kelompok</label>
                        <select name="kelompok" class="form-control" onchange="this.form.submit();">
                            <option value="" style="text-align: center">-- Pilih Kelompok --</option>
                            <option value="Umum">Umum</option>
                            <option value="Wajib">Wajib</option>
                            <option value="Muatan Lokal">Muatan Lokal</option>
                        </select>  
                    </div> 
                </div>           
            </form>
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>No.</th>
                      <th>Kode</th>
                      <th style="width: 30%">Mapel</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($mapel as $item)
              <tbody>
                <td class="text-center">{{ $loop->iteration + ($mapel->currentPage()-1) * $mapel->perPage() }}</td>
                <td class="text-center">{{$item->kode}}</td>
                <td>{{$item->mapel}}</td>
                <td class="text-center">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ModalEdit{{$item->kode}}">
                        <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                    </button>
                </td>
              </tbody>
              @endforeach
            </table>
            <div class="modal-footer justify-content-between">
                {{$mapel->links()}}
            </div>
          </div>
    </div>
</div>

<!-- Extra large modal -->
<div class="modal fade  ModalBesar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah List Mapel</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('simpan-mapel')}}" method="post">
            @csrf
            <table class="table text-center dinamis">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Mapel</th>
                        <th>Kelompok</th>
                        <th>Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="kode[0]" value="SD3" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nama[0]" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="mapel[0]" required>
                        </td>
                        <td>
                            <select name="kelompok[0]" class="form-control" required>
                                <option value="Umum">Umum</option>
                                <option value="Wajib">Wajib</option>
                                <option value="Muatan Lokal">Muatan Lokal</option>
                            </select>
                        </td>
                        <td>
                            <button type="button" id="btn-tambah" name="tambah" class="btn btn-primary">Tambah</button>
                        </td>
                    </tr>
                </tbody>
            </table>
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
@foreach ($mapel as $item)
    
<div class="modal fade  ModalEdit{{$item->kode}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Edit List Mapel</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('update-mapel',$item->kode)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <table class="table text-center dinamis">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Mapel</th>
                        <th>Kelompok</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="kode"value="{{$item->kode}}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nama"  value="{{$item->nama}}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="mapel"  value="{{$item->mapel}}">
                        </td>
                        <td>
                            <select name="kelompok" class="form-control">
                                <option value="{{$item->kelompok}}">{{$item->kelompok}}</option>
                                <option value="Umum">Umum</option>
                                <option value="Wajib">Wajib</option>
                                <option value="Muatan Lokal">Muatan Lokal</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div class="modal-footer justify-content-between">
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
        $("#DataMapel").addClass("active");

        var i = 0;
        $('#btn-tambah').click(function (){
            ++i;
            $('.dinamis').append('<tr><td><input type="text" class="form-control" name="kode['+i+']" value="SD3" required></td><td><input type="text" class="form-control" name="nama['+i+
            ']" required></td><td><input type="text" class="form-control" name="mapel['+i+']" required></td><td><select name="kelompok['+i+']" class="form-control" required><option value="Umum">Umum</option><option value="Wajib">Wajib</option><option value="Muatan Lokal">Muatan Lokal</option><option value="Ekstra Kulikuler">Ekstra Kulikuler</option></select></td><td><button type="button" class="btn btn-danger dinamis-hapus">Hapus</button></td></tr>')
        });
        $(document).on('click','.dinamis-hapus',function(){
            $(this).parents('tr').remove();
        })

    </script>
@endsection