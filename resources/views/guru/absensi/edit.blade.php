@extends('template.home')
@section('heading', 'Edit Data Absensi')
@section('page')
  <li class="breadcrumb-item active">Edit Data Absensi</li>
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
        <div class="col-md-12">
            <div class="card-body">
                <form action="{{route('absensi-update')}}" method="POST">
                    @csrf
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="tahun" value="{{$tahun->id}}">
                <table class="table text-center" id="example3">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pertemuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @if ($pertemuan == null)
                                <input type="date" name="tgl" class="form-control" value="">
                                @else
                                <input type="date" name="tgl" class="form-control" value="{{$pertemuan->tgl}}">
                                @endif
                                
                            </td>
                            <td>
                                @if ($pertemuan == null)
                                <input type="number" name="pertemuan" class="form-control" value="">
                                @else
                                <input type="number" name="pertemuan" class="form-control" value="{{$pertemuan->pertemuan}}">
                                @endif
                               
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table id="example3" class="table" >
                    <thead>
                        <tr>
                            <th style="width: 10%;text-center">NO</th>
                            <th style="width: 60%;text-center">Nama</th>
                            <th style="width: 30%;text-center">Keterangan</th>
                        </tr>
                    </thead>
                    @foreach ($absensi as $item)
                    <tbody>
                        
                        {{-- <input type="show" name="kelas" value="{{$pembagian->kelas_id}}">
                        <input type="show" name="mapel" value="{{$pembagian->mapel_id}}"> --}}
                        
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <input type="hidden" name="pertemuan_id[]" value="{{$item->id}}">
                                <input type="hidden" name="siswa[]" value="{{$item->siswa_id}}">{{$item->siswa->nama}}
                            </td>
                            <td>
                                <select name="keterangan[]" class="form-control" required>
                                    <option value="{{$item->keterangan}}">{{$item->keterangan}}</option>
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
                <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
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