@extends('template.home')
@section('heading', 'Edit Data Siswa')
@section('page')
  <li class="breadcrumb-item active">Edit Data Siswa</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('siswa')}}" type="button" class="btn btn-default btn-sm" >
                    <i class="nav-icon fas fa-long-arrow-alt-left"></i> &nbsp; Kembali
                </a>
            </h3>
        </div>

        <!-- /.card-header -->
            
        <div class="card-body">
            <div class="col-md-12">
                <form action="{{route('siswa-update',$siswa->id)}}" method="POST">
                    <div class="row">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="col-md-6">
                            <label for="">NISN</label>
                            <input type="number" name="nisn" class="form-control" value="{{$siswa->nisn}}">
                        </div>
                        <div class="col-md-6">
                            <label for="">NIS</label>
                            <input type="number" name="nis" class="form-control" value="{{$siswa->nis}}"">
                        </div>
                        <div class="col-md-6">
                            <label for="">Namea</label>
                            <input type="text" name="nama" class="form-control" value="{{$siswa->nama}}"">
                        </div>
                        <div class="col-md-3">
                            <label for="">Tempat Lahir</label>
                            <input type="text" name="tmp" class="form-control" value="{{$siswa->tmp}}"">
                        </div>
                        <div class="col-md-3">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" name="tgl" class="form-control" value="{{$siswa->tgl}}"">
                        </div>
                        <div class="col-md-6">
                            <label for="">Janis Kelamin</label>
                            <select name="jk" id="" class="form-control">
                                <option value="{{$siswa->jk}}">{{$siswa->jk}}</option>
                                <option value="Laki-laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Agama</label>
                            <select name="agama" id="" class="form-control">
                                <option value="{{$siswa->agama}}">{{$siswa->agama}}</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Islam">Islam</option>
                                <option value="Buddha">Budha</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Khonghucu">Khonghucu</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{$siswa->alamat}}">
                        </div>
                        <div class="col-md-6">
                            <label for="">Nama Ayah</label>
                            <input type="text" name="ayah" class="form-control" value="{{$siswa->ayah}}">
                        </div>
                        <div class="col-md-6">
                            <label for="">Nama Ibu</label>
                            <input type="text" name="ibu" class="form-control" value="{{$siswa->ibu}}">
                        </div>
                        <div class="col-md-6">
                            <label for="">No Handphone</label>
                            <input type="number" name="tlp" class="form-control" value="{{$siswa->tlp}}">
                        </div>
                        <div class="col-md-6">
                            <label for="">Kelas</label>
                            <select name="kelas_id" id="" class="form-control">
                                <option value="{{$siswa->kelas_id}}">Kelas {{$siswa->kelas->kelas}}</option>
                                @foreach ($kelas as $item)
                                    <option value="{{$item->id}}">Kelas {{$item->kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="{{$siswa->status}}">{{$siswa->status}}</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Lulus">Lulus</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataSiswa").addClass("active");

    </script>
@endsection