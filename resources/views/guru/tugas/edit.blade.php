@extends('template.home')
@section('heading', 'Edit Nilai Tugas')
@section('page')
  <li class="breadcrumb-item active">Edit Nilai Tugas</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('tugas')}}" type="button" class="btn btn-default btn-sm" >
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
                    <form action="{{route('update-tugas')}}" method="POST">
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
                                        @if ($tg == null)
                                            <input type="number" name="ke" class="form-control">
                                        @else
                                            <input type="number" name="ke" class="form-control" value="{{$tg->ke}}">
                                        @endif
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
                                @foreach ($tugas as $item)
                                    <tr>
                                        <input type="hidden" name="tugas_id[]" value="{{$item->id}}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
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
          <h4 class="modal-title">Tambah Data Tugas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('simpan-tugas-tambah')}}" method="post">
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
                            Tugas Ke -
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="number" name="ke" class="form-control" required>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="example3" class="table table-bordered table-striped table-hover">
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
        $("#Tugas").addClass("active");

    </script>
@endsection