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

            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <form action="{{route('gcari')}}" method="GET">
            <table class="table">
                <label for="hari">Hari</label>
                <select name="cari" id="" class="form-control" onchange="this.form.submit();">
                    <option value="">-- Pilih Hari --</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jum'at</option>
                    <option value="sabtu">Sabtu</option>
                </select>           
            </table>
        </form>
            <table id="example3" class="table table-bordered table-striped table-hover text-center">
              <thead>
                  <tr>
                      <th>Hari</th>
                      <th>Kelas</th>
                      <th>Jam</th>
                      <th>Mapel</th>
                  </tr>
              </thead>
              @foreach ($jadwal as $item)
              <tbody>
                <td>{{$item->hari}}</td>
                  <td>{{ $item->kelas->kelas}}</td>
                <td>{{ $item->jam }}</td>
                <td>{{$item->mapel->nama}}</td>
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
        $("#JadwalGuru").addClass("active");
    </script>
@endsection