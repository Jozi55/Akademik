@extends('template.home')
@section('heading', 'Data List Kelas')
@section('page')
  <li class="breadcrumb-item active">Data List Kelas</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".ModalBesar">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Kelas
                </button>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example3" class="table table-bordered table-hover">
              <thead class="text-center">
                  <tr>
                      <th>No.</th>
                      <th>Kelas</th>
                      <th>Wali</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              <tbody >
                @foreach ($wali as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{$item->kelas->kelas}}</td>
                    @if ($item->guru_id == null)
                        <td>Tidak Ada Wali</td>
                    @else
                    <td>{{$item->guru->nama}}</td>
                    @endif
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ModalEdit{{$item->id}}">
                            <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                        </button>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
    </div>
</div>

<!-- Extra large modal -->
<div class="modal fade  ModalBesar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data Kelas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('simpan-kelas')}}" method="post">
            @csrf
            <table class="table text-center dinamis">
                <thead>
                    <tr>
                        <th>Kelas</th>
                        <th>Wali</th>
                        <th>Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="kelas[0]" class="form-control">
                                <option value="1">Kelas 1</option>
                                <option value="2">Kelas 2</option>
                                <option value="3">Kelas 3</option>
                                <option value="4">Kelas 4</option>
                                <option value="5">Kelas 5</option>
                                <option value="6">Kelas 6</option>
                            </select>
                        </td>
                        <td>
                            <select  name="guru[0]" class="form-control">
                                <option value="">Tidak Ada</option>
                                @foreach ($guru as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
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
@foreach ($wali as $item)
    
<div class="modal fade  ModalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Edit Data kelas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('update-kelas',$item->id)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="row text-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="guru">Guru</label>
                        <select name="guru" class="select2bs4 form-control">
                            @if ($item->guru_id == null)
                            <option value="">Tidak Ada</option>

                            @else
                            <option value="{{$item->guru_id}}">{{$item->guru->nama}}</option>
                            @endif
                            <option value="">Tidak Ada</option>
                            @foreach ($guru as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
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
        $("#DataKelas").addClass("active");

        var i = 0;
        $('#btn-tambah').click(function (){
            ++i;
            $('.dinamis').append('<tr><td><select name="kelas['+i+']" class="form-control"><option value="1">Kelas 1</option><option value="2">Kelas 2</option><option value="3">Kelas 3</option><option value="4">Kelas 4</option><option value="5">Kelas 5</option><option value="6">Kelas 6</option></select></td><td><select name="guru['
            +i+']" class="form-control"><option value="">Tidak Ada</option>@foreach ($guru as $item)<option value="{{$item->id}}">{{$item->nama}}</option>@endforeach</select></td><td><button type="button" class="btn btn-danger dinamis-hapus">Hapus</button></td></tr>')
        });
        $(document).on('click','.dinamis-hapus',function(){
            $(this).parents('tr').remove();
        })
    </script>
@endsection