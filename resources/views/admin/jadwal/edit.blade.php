@extends('template.home')
@section('heading', 'Edit Data Jadwal')
@section('page')
  <li class="breadcrumb-item active">Edit Data Jadwal</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a type="button" class="btn btn-default btn-sm" href="{{route('jadwal')}}" >
                    <i class="nav-icon fas fa-long-arrow-alt-left"></i> &nbsp; Kembali
                </a>
            </h3>
        </div>
            <div class="col-md-12">
                <div class="card table-responsive">
                    <!-- /.card-header -->
                    <form action="{{route('update-jadwal',$jadwal->id)}}" method="post">
                        @csrf
                        {{ method_field('PATCH') }}
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th>Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="kelas" class="form-control" >
                                            <option value="{{$jadwal->kelas_id}}">Kelas {{$jadwal->kelas->kelas}}</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{$item->id}}">Kelas {{$item->kelas}}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="hari" class="form-control">
                                            <option value="{{$jadwal->hari}}" >{{$jadwal->hari}}</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                    </td>

                                </tr>
                            </tbody>
                        </table>

                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th style="width: 25%">Jam</th>
                                    <th style="width: 50%">Mapel</th>
                                    <th>Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="time" class="form-control" name="jam" value="{{$jadwal->jam}}">
                                    </td>
                                    <td>
                                        <select name="mapel" class="form-control">
                                            <option value="{{$jadwal->mapel_kode}}">{{$jadwal->mapel->mapel}}</option>
                                            @foreach ($mapel as $item)
                                                <option value="{{$item->kode}}">{{$item->mapel}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="guru" id="" class="form-control">
                                            @if ($jadwal->guru_id == null)
                                                <option value="">-</option>
                                            @else
                                            <option value="{{$jadwal->guru_id}}">{{$jadwal->guru->nama}}</option>
                                            @endif
                                            <option value="">-</option>
                                            @foreach ($guru as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
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


@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataJadwal").addClass("active");
    </script>
@endsection