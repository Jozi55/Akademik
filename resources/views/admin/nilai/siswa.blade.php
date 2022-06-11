@extends('template.home')
@section('heading', 'Data Nilai')
@section('page')
  <li class="breadcrumb-item active">Data Nilai</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a type="button" class="btn btn-default btn-sm" href="{{route('admin-nilai')}}">
                    <i class="nav-icon fas fa-long-arrow-alt-left"></i> &nbsp; Kembali
                </a>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <form action="{{route('admin-siswa-cari',$kelas->id)}}" method="GET">
                <div class="row text-center">
                    <div class="col-md-4">
                        <label for="name">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="input nama siswa">
                    </div>
                    <div class="col-md-2">
                        <label for="status" style="text-align: center">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                            <option value="lulus">Lulus</option>
                        </select>  
                    </div>
                    <div class="col-md-2">
                        <label for="" >Aksi</label>
                        <div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>  
                </div>           
            </form>          
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>NO</th>
                      <th>Nama</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($siswa as $item)
              <tbody>
                <td class="text-center">{{$loop->iteration}}</td>
                <td>{{$item->nama}}</td>
                <td class="text-center">
                    <button class="btn btn-default btn-sm"  data-toggle="modal" data-target=".ModalView{{$item->id}}">
                        <i class="nav-icon far fa-file-pdf"></i> &nbsp; Cetak
                    </button>
                </td>
              </tbody>
              @endforeach
            </table>
          </div>
    </div>
</div>


@foreach ($siswa as $item)
<div class="modal fade ModalView{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <form method="get" action="{{route('admin-cetak-nilai',$item->id)}}" target="_blank">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="p">Tahun</label>
                                <select name="tahun" class="form-control select2bs4">
                                    @foreach ($tahun as $item)
                                        <option value="{{$item->id}}">{{$item->tahun}} - {{$item->semester}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="form-control btn-primary"><i class="nav-icon far fa-file-pdf"></i> &nbsp; Cetak</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
@endforeach
@endsection
@section('script')
    <script>
        $("#liMasterData").addClass("menu-open");
        $("#AdminNilai").addClass("active");
    </script>
@endsection