@extends('template.home')
@section('heading', 'Data KKM')
@section('page')
  <li class="breadcrumb-item active">Data KKM</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
            </h3>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>Kelas</th>
                      <th>Mapel</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($pembagian as $item)
              <tbody >
                <td class="text-center">{{$item->kelas->kelas}}</td>
                <td>{{$item->mapel->mapel}}</td>
                <td class="text-center">
                    <a type="button" class="btn btn-primary btn-sm" href="{{route('kkm-tambah',$item->id)}}">
                        <i class="nav-icon fas fa-folder-plus"></i> &nbsp;Input
                    </a>
                    <a type="button" class="btn btn-primary btn-sm" href="{{route('edit-kkm',$item->id)}}">
                        <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                    </a>
                </td>
              </tbody>
              @endforeach
            </table>
          </div>
    </div>
</div>

{{-- 
@foreach ($kelas as $item)
<div class="modal fade ModalInput{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <form method="get" action="{{route('kkm-tambah',$item->id)}}">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="p">Mapel</label>
                                <select name="mapel" class="form-control">
                                    @foreach ($mapel as $item)
                                        <option value="{{$item->kode}}">{{$item->mapel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <button class="form-control btn-primary">Input</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
@endforeach

@foreach ($kelas as $item)
<div class="modal fade ModalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <form method="get" action="{{route('edit-kkm',$item->id)}}">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="p">Mapel</label>
                                <select name="mapel" class="form-control">
                                    @foreach ($mapel as $item)
                                        <option value="{{$item->kode}}">{{$item->mapel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <button class="form-control btn-primary">Edit</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
@endforeach --}}

@endsection
@section('script')
    <script>
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#KKM").addClass("active");
    </script>
@endsection