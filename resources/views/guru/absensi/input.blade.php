@extends('template.home')
@section('heading', 'Inpu Absensi')
@section('page')
  <li class="breadcrumb-item active">Inpu Absensi</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('absensi')}}" type="button" class="btn btn-default btn-sm" >
                    <i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali
                </a>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-12">
                <form action="{{route('simpan-absensi')}}" method="POST">
                    @csrf
                    <input type="hidden" name="tahun" value="{{$tahun->id}}">
                    <input type="hidden" name="kelas" value="{{$pembagian->kelas_id}}">
                    <input type="hidden" name="mapel" value="{{$pembagian->mapel_kode}}">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pertemuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="date" name="tgl" class="form-control" required>
                                </td>
                                <td>
                                   <input type="number" name="pertemuan" class="form-control" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table dinamis">
                        <thead class="text-center">
                            <tr>
                                <td>No</td>
                                <th style="width: 60%">Nama</th>
                                <th style="width: 30%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="scrol">
                            @foreach ($siswa as $siswas)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <input type="hidden" name="siswa[]" value="{{$siswas->id}}">{{$siswas->nama}}
                                </td>
                                <td class="text-center">
                                    <select name="keterangan[]" class="form-control" required>
                                        <option value="Hadir">Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                    </select>
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
        $("#AbsenSiswa").addClass("active");
    </script>
@endsection