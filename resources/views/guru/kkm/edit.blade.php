@extends('template.home')
@section('heading', 'Edit Data KKM')
@section('page')
  <li class="breadcrumb-item active">Edit Data KKM</li>
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
                    <form action="{{route('update-kkm')}}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="kkm_id" value="{{$kkm->id}}">
                        <input type="hidden" name="des_id" value="{{$des->id}}">
                        <input type="hidden" name="kelas" value="{{$kkm->kelas_id}}">
                        <input type="hidden" name="mapels" value="{{$kkm->mapel_kode}}">
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
                                        <input type="number" name="kkm" class="form-control" value="{{$kkm->kkm}}">
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
                                <input type="hidden" name="tahun" value="{{$kkm->tahun_id}}">
                                    <tr>
                                        <td>
                                            <input type="number" name="a" class="form-control" value="{{$des->a}}">
                                        </td>
                                        <td>
                                            <input type="number" name="b" class="form-control" value="{{$des->b}}">
                                        </td>
                                        <td>
                                            <input type="number" name="c" class="form-control" value="{{$des->c}}">
                                        </td>
                                        <td>
                                            <input type="number" name="d" class="form-control" value="{{$des->d}}">
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
                                        <textarea type="text" name="dpa" class="form-control">{{$des->dpa}}</textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dpb" class="form-control">{{$des->dpb}}</textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dpc" class="form-control">{{$des->dpc}}</textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dpd" class="form-control">{{$des->dpd}}</textarea>
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
                                        <textarea type="text" name="dka" class="form-control">{{$des->dka}}</textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dkb" class="form-control">{{$des->dkb}}</textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dkc" class="form-control">{{$des->dkc}}</textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" name="dkd" class="form-control">{{$des->dkd}}</textarea>
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