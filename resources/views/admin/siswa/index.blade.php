@extends('template.home')
@section('heading', 'Data Siswa')
@section('page')
  <li class="breadcrumb-item active">Data Siswa</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('siswa-tambah')}}" type="button" class="btn btn-default btn-sm"><i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Siswa</a>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <form action="{{route('siswa-cari')}}" method="GET">
                <div class="row text-center">
                    <div class="col-md-4">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="" class="form-control">
                            <option value="" style="text-align: center">-- Pilih Kelas --</option>
                            @foreach ($kelas as $item)
                            <option value="{{$item->id}}">Kelas {{$item->kelas}}</option>
                            @endforeach 
                    </select>
                    </div>
                    <div class="col-md-4">
                        <label for="name">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="input nama siswa">
                    </div>
                    <div class="col-md-2">
                        <label for="status" style="text-align: center">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Lulus">Lulus</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>  
                    </div>
                    <div class="col-md-2">
                        <label for="" >Aksi</label>
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-search"></i>&nbsp; Cari</button>
                        </div>
                    </div>  
                </div>           
            </form>
            
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>No</th>
                      <th>Kelas</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($siswa as $item)
              <tbody>
                <td class="text-center">{{ $loop->iteration + ($siswa->currentPage()-1) * $siswa->perPage() }}</td>
                <td class="text-center">{{ $item->kelas->kelas }}</td>
                <td>{{$item->nis}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->alamat}}</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{route('siswa-edit',$item->id)}}">
                        <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                    </a>
                </td>
              </tbody>
              @endforeach
            </table>
            <br/>
            {{-- Halaman : {{ $siswa->currentPage() }} <br/>
            Jumlah Data : {{ $siswa->total() }} <br/>
            Data Per Halaman : {{ $siswa->perPage() }} <br/> --}}
            <div class="modal-footer justify-content-between">
                {{ $siswa->links() }}
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