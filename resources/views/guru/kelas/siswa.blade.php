@extends('template.home')
@section('heading', 'Data Siswa')
@section('page')
  <li class="breadcrumb-item active">Data Siswa</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{route('list-siswa')}}" type="button" class="btn btn-default btn-sm" >
                <i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali
            </a>
        </div>
        <!-- /.card-header -->
        @foreach ($siswa as $siswa)
            
        <div class="card-body">
            <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">NISN</label>
                            <input type="text" name="nisn" class="form-control" value="{{$siswa->nisn}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">NIS</label>
                            <input type="text" name="nis" class="form-control" value="{{$siswa->nis}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Namea</label>
                            <input type="text" name="nama" class="form-control" value="{{$siswa->nama}}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="">Tempat Lahir</label>
                            <input type="text" name="tmp" class="form-control" value="{{$siswa->tmp}}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" name="tgl" class="form-control" value="{{$siswa->tgl}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Janis Kelamin</label>
                            <input value="{{$siswa->jk}}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Agama</label>
                            <input value="{{$siswa->agama}}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{$siswa->alamat}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Nama Ayah</label>
                            <input type="text" name="ayah" class="form-control" value="{{$siswa->ayah}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Nama Ibu</label>
                            <input type="text" name="ibu" class="form-control" value="{{$siswa->ibu}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">No Handphone</label>
                            <input type="text" name="tlp" class="form-control" value="{{$siswa->tlp}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Kelas</label>
                            <input value="Kelas {{$siswa->kelas_id}}" class="form-control" readonly>
                        </div>
                    </div> 
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#Wali").addClass("active");
    </script>
@endsection