@extends('template.home')
@section('heading', 'Tambah Data Jadwal')
@section('page')
  <li class="breadcrumb-item active">Tambah Data Jadwal</li>
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
            <div class="col-md-12 table-responsive">
                <div class="card ">
                    <!-- /.card-header -->
                    <form action="{{route('simpan-jadwal')}}" method="post">
                        @csrf
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Tahun Pelajaran</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="tahun" class="select2bs4 form-control">
                                            @foreach ($tahun as $item)
                                                <option value="{{$item->id}}">{{$item->tahun}} - {{$item->semester}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="kelas" class="select2bs4 form-control" required>
                                            <option value="">--- Pilih Kelas ---</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{$item->id}}">Kelas {{$item->kelas}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table text-center dinamis">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Hari</th>
                                    <th style="width: 25%">Jam</th>
                                    <th style="width: 25%">Mapel</th>
                                    <th style="width: 25%">Guru</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="hari[0]" class="select2bs4 form-control">
                                            <option value="">--- Pilih Hari ---</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="time" class="form-control" name="jam[0]">
                                    </td>
                                    <td>
                                        <select name="mapel[0]" class="select2bs4 form-control">
                                            <option value="">--- Pilih Mapel ---</option>
                                            @foreach ($mapel as $item)
                                                <option value="{{$item->kode}}">{{$item->mapel}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="guru[0]" class="select2bs4 form-control">
                                            <option value="">--- Pilih Guru ---</option>
                                            <option value="">-</option>
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

        var i = 0;
        $('#btn-tambah').click(function (){
            ++i;
            $('.dinamis').append('<tr> <td><select id="ha'+i+'" name="hari['
            +i+']" class="select2bs4 form-control"><option value="">--- Pilih Hari ---</option><option value="Senin">Senin</option><option value="Selasa">Selasa</option><option value="Rabu">Rabu</option><option value="Kamis">Kamis</option><option value="Jumat">Jumat</option><option value="Sabtu">Sabtu</option></select></td><td><input type="time" class="form-control" name="jam['
            +i+']"></td><td><select id="ma'+i+'" name="mapel['
            +i+']" class=" form-control"><option value="">--- Pilih Mapel ---</option>@foreach ($mapel as $item)<option value="{{$item->kode}}">{{$item->mapel}}</option>@endforeach</select></td><td><select id="gu'+i+'" name="guru['
            +i+']" class="select2bs4 form-control"><option value="">--- Pilih Guru ---</option><option value="">-</option>@foreach ($guru as $item)<option value="{{$item->id}}">{{$item->nama}}</option>@endforeach</select></td><td><button type="button" class="btn btn-danger dinamis-hapus">Hapus</button></td></tr>')
            $('#ha'+i+'').select2({
                theme: 'bootstrap4'
            })
            $('#gu'+i+'').select2({
                theme: 'bootstrap4'
            })
            $('#ma'+i+'').select2({
                theme: 'bootstrap4'
            })
        });
        $(document).on('click','.dinamis-hapus',function(){
            $(this).parents('tr').remove();
        })
    </script>
@endsection