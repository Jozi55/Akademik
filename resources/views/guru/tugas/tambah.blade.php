@extends('template.home')
@section('heading', 'Input Nilai Tugas')
@section('page')
  <li class="breadcrumb-item active">Input Nilai Tugas</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('tugas')}}" type="button" class="btn btn-default btn-sm" >
                    <i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali
                </a>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-12">
                    <form action="{{route('simpan-tugas')}}" method="POST">
                        @csrf
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
                                    <label for="" style="font-size: 13px; color: red;">* Nilai tugas yang sudah diinput  : Tugas Ke </label>
                                    @foreach ($tu_i as $item)
                                        <label  style="font-size: 13px; color: red;">  {{$item->ke}} ,</label>   
                                    @endforeach
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
                                    <td>No</td>
                                    <th style="width:80%">Nama</th>
                                    <th >Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="scrol">
                                @foreach ($siswa as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <input type="hidden" name="tahun" value="{{$tahun->id}}">
                                            <input type="hidden" name="siswa_id[]" value="{{$item->id}}">{{$item->nama}}
                                        </td>
                                        <td>
                                            <input type="number" maxlength="3" name="nilai[]" class="form-control" required>
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
@endsection

@section('script')
    <script>
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Tugas").addClass("active");

    </script>
@endsection