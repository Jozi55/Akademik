@extends('template.home')
@section('heading', 'Edit Nilai Ulangan')
@section('page')
  <li class="breadcrumb-item active">Edit Nilai Ulangan</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('ulangan')}}" type="button" class="btn btn-default btn-sm" >
                    <i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali
                </a>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ModalTambah">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Baru
                </button>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-12">
                    <form action="{{route('ulangan-update')}}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="kelas" value="{{$pembagian->kelas_id}}">
                        <input type="hidden" name="mapels" value="{{$pembagian->mapel_kode}}">
                        @foreach ($nilai as $item)
                            <input type="hidden" name="nilai_id[]" value="{{$item->id}}">
                        @endforeach
                        @foreach ($rapot as $item)
                            <input type="hidden" name="rapot_id[]" value="{{$item->id}}">
                        @endforeach
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        Keterangan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select id="ktn" name="keterangan" class="form-control">
                                            @if ($ul == null)
                                    
                                            @else
                                            <option value="uh" {{$ul->keterangan == 'uh' ? 'selected' : ''}}>Ulangan Harian</option>
                                            <option value="pts" {{$ul->keterangan == 'pts' ? 'selected' : ''}}>Penilaian Tengah Semester</option>
                                            <option value="pas" {{$ul->keterangan == 'pas' ? 'selected' : ''}}>Penilaian Akhit Semester</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <input id="kets" type="number" name="ke" class="form-control" value="{{$ke}}" placeholder="Ke -">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="example3" class="table table-bordered table-striped table-hover">
                            <thead class="text-center">
                                <tr>
                                    <td>No</td>
                                    <th style="width:80%">Nama</th>
                                    <th >Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="scrol">
                                @foreach ($ulangan as $item)
                                
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <input type="hidden" name="ulangan_id[]" value="{{$item->id}}">
                                            <input type="hidden" name="tahun" value="{{$tahun->id}}">
                                            <input type="hidden" name="siswa_id[]" value="{{$item->siswa_id}}">{{$item->siswa->nama}}
                                        </td>
                                        <td>
                                            <input type="number" name="nilai[]" class="form-control" value="{{$item->nilai}}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Extra large modal -->
<div class="modal fade  ModalTambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data Ulangan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('ulangan-simpan-tambah')}}" method="post">
            @csrf
            <input type="hidden" name="tahun" value="{{$tahun->id}}">
            <input type="hidden" name="kelas" value="{{$pembagian->kelas_id}}">
            <input type="hidden" name="mapels" value="{{$pembagian->mapel_kode}}">
            @foreach ($nilai as $item)
                <input type="hidden" name="nilai_id" value="{{$item->id}}">
            @endforeach
            @foreach ($rapot as $item)
                <input type="hidden" name="rapot_id" value="{{$item->id}}">
            @endforeach
            <table>
                <thead>
                    <tr>
                        <th>
                            Keterangan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="keterangan" class="form-control">
                                <option value="uh">Ulangan Harian</option>
                                <option value="pts">Penilaian Tengah Semester</option>
                                <option value="pas">Penilaian Akhit Semester</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="ke" class="form-control" placeholder="Ke -">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="example3" class="table">
                <thead class="text-center">
                    <tr>
                        <th style="width:80%">Nama</th>
                        <th >Nilai</th>
                    </tr>
                </thead>
                <tbody class="scrol">
                        <tr>
                            <td>
                                <select name="siswa_id" class="form-control select2bs4">
                                    @foreach ($siswa as $siswas)
                                    <option value="{{$siswas->id}}">{{$siswas->nama}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="nilai" class="form-control" required>
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
@endsection

@section('script')
    <script>
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Ulangan").addClass("active");
    </script>
@endsection