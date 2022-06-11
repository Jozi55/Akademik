@extends('template.home')
@section('heading', "Tambah Data KKM")
@section('page')
  <li class="breadcrumb-item active">Tambah Data KKM </li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('kkm')}}" type="button" class="btn btn-default btn-sm" >
                    <i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali
                </a>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-12">
                    <form action="{{route('kkm-simpan')}}" method="POST">
                        @csrf
                        <input type="hidden" name="kelas" value="{{$pembagian->kelas_id}}">
                        <input type="hidden" name="mapels" value="{{$pembagian->mapel_kode}}">
                        <table id="example3" class="table">
                            <thead>
                                <tr>
                                    <th>
                                        KKM
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" name="kkm" class="form-control" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="example3" class="table">
                            <thead class="text-center">
                                <tr>
                                    <th >Minimum Nilai A</th>
                                    <th >Minimum Nilai B</th>
                                    <th >Minimum Nilai C</th>
                                    <th >Minimum Nilai D</th>
                                </tr>
                            </thead>
                            <tbody class="scrol">
                                <input type="hidden" name="tahun" value="{{$tahun->id}}">
                                    <tr>
                                        <td>
                                            <input type="number" name="a" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="b" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="c" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="d" class="form-control" required>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                        <table id="example3" class="table">
                            <thead class="text-center">
                                <tr>
                                    <th >Deskripsi Nilai A</th>
                                    <th >Deskripsi Nilai B</th>
                                    <th >Deskripsi Nilai C</th>
                                    <th >Deskripsi Nilai D</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea type="text" name="dpa" class="form-control" required></textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dpb" class="form-control" required></textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dpc" class="form-control" required></textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dpd" class="form-control" required></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="example3" class="table">
                            <thead class="text-center">
                                <tr>
                                    <th >Deskripsi Ketrampilan Nilai A</th>
                                    <th >Deskripsi Ketrampilan Nilai B</th>
                                    <th >Deskripsi Ketrampilan Nilai C</th>
                                    <th >Deskripsi Ketrampilan Nilai D</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea type="text" name="dka" class="form-control" required></textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dkb" class="form-control" required></textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dkc" class="form-control" required></textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dkd" class="form-control" required></textarea>
                                    </td>
                                </tr>
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
        $("#KKM").addClass("active");
    </script>
@endsection