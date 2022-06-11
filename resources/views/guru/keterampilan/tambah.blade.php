@extends('template.home')
@section('heading', 'Input Data Keterampilan')
@section('page')
  <li class="breadcrumb-item active">Input Data Keterampilan</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('keterampilan')}}" type="button" class="btn btn-default btn-sm" >
                    <i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali
                </a>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-12">
                    <form action="{{route('simpan-keterampilan')}}" method="POST">
                        @csrf
                        <input type="hidden" name="tahun" value="{{$tahun->id}}">
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
                                        KD
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="kd" class="form-control">
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
                                            <input type="hidden" name="siswa_id[]" value="{{$item->id}}">{{$item->nama}}
                                        </td>
                                        <td>
                                            <input type="number" name="nilai[]" class="form-control" required>
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
        $("#Keterampilan").addClass("active");

    </script>
@endsection