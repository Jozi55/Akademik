@extends('template.home')
@section('heading', 'View Data Absensi')
@section('page')
  <li class="breadcrumb-item active">View Data Absensi</li>
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
   
            <table id="example3" class="table table-bordered table-striped table-hover table-respondiv">
                    <div class="row text-center">
                        <form action="{{route('absensi-viewcari',$pembagian->id)}}">
                            <div class="col-md-3">
                                <input type="number" name="pertemuan" class="form-control" placeholder="Pertemuan Ke -">
                            </div> 
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Cari</button>
                            </div>
                        </form>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target=".ModalCetak"><i class="fas fa-print"></i>&nbsp; Cetak 1 Pertemuan</button>
                            <a type="button" class="btn btn-primary" href="{{route('absensi-allpdf',$pembagian->id)}}" target="_blank"><i class="fas fa-print"></i>&nbsp; Cetak Semua</a>
                        </div> 
                    </div>           
              <thead>
                  <tr>
                      <th>Pertemuan</th>
                      <th>Nama</th>
                      <th>Keterangan</th>
                  </tr>
              </thead>
              @foreach ($absensi as $item)
              <tbody>
                    <tr>
                        <td>{{$item->pertemuan}}</td>
                        <td>{{$item->siswa->nama}}</td>
                        <td>{{$item->keterangan}}</td>
                        
                    </tr>
              </tbody>
              @endforeach
            </table>
            <div class="modal-footer justify-content-between">
                {{$absensi->links()}}
            </div>
          </div>
    </div>
</div>
{{-- 
<div class="modal fade Modalcari" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <form method="get" action="{{route('absensi-viewcari',$pembagian->id)}}">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="p">Pertemuan Ke -</label>
                                <input type="number" name="pA" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <button class="form-control btn-primary">Cari</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div> --}}

<div class="modal fade ModalCetak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <form method="get" action="{{route('absensi-viewpdf',$pembagian->id)}}" target="_blank">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="p">Pertemuan Ke -</label>
                                <input type="number" name="pA" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <button class="form-control btn-primary">Cetak</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>

@endsection
@section('script')
    <script>
        $("#AbsenSiswa").addClass("active");
    </script>
@endsection