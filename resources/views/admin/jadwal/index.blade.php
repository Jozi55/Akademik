@extends('template.home')
@section('heading', 'Data Jadwal')
@section('page')
  <li class="breadcrumb-item active">Data Jadwal</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a type="a" class="btn btn-default btn-sm" href="{{route('tambah-jadwal')}}" >
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Jadwal
                </a>
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".ModalView">
                    <i class="nav-icon far fa-file-pdf"></i> &nbsp; Cetak Jadwal
                </button>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".dropJadwalAll">
                    <i class="nav-icon fas fa-minus-circle"></i> &nbsp; Hapus Semua
                </button>
            </h3>
        </div>

        
        <div class="modal fade ModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
                    <form method="get" action="{{route('view-jadwal')}}" target="_blank">
                    @csrf
					<div class="modal-content">
						<div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Kelas</label>
                                <select name="kelas" id="" class="form-control text-center" onchange="this.form.submit();" >
                                    <option value="">--- Pilih Kelas ---</option>
                                    @foreach ($kelas as $item)
                                    <option value="{{$item->id}}">Kelas {{$item->kelas}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
					</div>
				</form>
			</div>
		</div>
        
        @foreach ($jadwal as $item)   
        <div class="modal fade dropJadwal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
                    <form method="post" action="{{route('hapus-jadwal',$item->id)}}">
                    @csrf
                    @method('delete')
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Anda yakin akan menghapus data ini?</h5>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-danger">Hapus</button>
						</div>
					</div>
				</form>
			</div>
		</div>
        @endforeach
        @foreach ($jadwal as $item)   
        <div class="modal fade dropJadwalAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
                    <form method="post" action="{{route('hapusAll-jadwal')}}">
                    @csrf
                    @method('delete')
					<div class="modal-content">
						<div class="modal-header">
						</div>
                        <div class="col-md-12">
                            <label for="">Tahun Pelajaran</label>
                            <select name="tahun" id="" class="form-control">
                                @foreach ($tahun as $item)
                                    <option value="{{$item->id}}">{{$item->tahun}}</option>
                                @endforeach
                            </select>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-danger">Hapus</button>
						</div>
					</div>
				</form>
			</div>
		</div>
        @endforeach

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <form action="{{route('cari')}}" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="" class="form-control">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $item)
                            <option value="{{$item->id}}" {{ $item->id == $kl ? 'selected' : '' }}>Kelas {{$item->kelas}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="tahun">Tahun Pelajaran</label>  
                        <select name="tahun" id="" class="form-control">
                            <option value="">-- Pilih Tahun Pelajaran --</option>
                            @foreach ($tahun as $item)
                                <option value="{{$item->id}}" {{ $item->id == $th ? 'selected' : '' }}>{{$item->tahun}}</option>
                            @endforeach
                        </select>  
                    </div>  
                    <div class="col-md-2">
                        <label for="">Cari</label>
                        <div>
                            <button class="submit btn btn-primary">Cari</button>
                        </div>
                    </div>    
                </div>
            </form>
            
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>Kelas</th>                      
                      <th>Hari</th>
                      <th>Jam</th>
                      <th>Mapel</th>
                      <th>Guru</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($jadwal as $item)
              <tbody>
                <td>{{$item->kelas->kelas}}</td>
                <td>{{$item->hari}}</td>
                <td>{{ $item->jam }}</td>
                <td>{{$item->mapel->nama}}</td>
                @if ($item->guru_id == null)
                    <td>-</td>
                @else
                    <td>{{$item->guru->nama}}</td>
                @endif
                <td class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{route('edit-jadwal',$item->id)}}">
                        <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                    </a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".dropJadwal{{$item->id}}">
                        <i class="nav-icon fas fa-minus-circle"></i> &nbsp; Hapus
                    </button>
                </td>
              </tbody>
              @endforeach
            </table>
            <div class="modal-footer justify-content-between">
                {{ $jadwal->links() }}
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
            $('.dinamis').append('<tr><td><input type="time" class="form-control" name="jam['+i+
        ']" required></td><td><select  name="mapel['+i+']" class="form-control" required> @foreach ($mapel as $item)<option value="{{$item->id}}">{{$item->kode}}</option>@endforeach</select></td><td><button type="button" class="btn btn-danger dinamis-hapus">Hapus</button></td></tr>')
        });
        $(document).on('click','.dinamis-hapus',function(){
            $(this).parents('tr').remove();
        })
    </script>
@endsection