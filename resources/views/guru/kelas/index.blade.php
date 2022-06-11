@extends('template.home')
@php
    $a = $kelas->kelas->kelas

@endphp
@section('heading', "Data Siswa Kelas $a")
@section('page')
  <li class="breadcrumb-item active">Data Siswa Kelas {{$kelas->kelas->kelas}}
</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
   
            <table id="example3" class="table table-bordered table-striped table-hover">
              <thead class="text-center">
                  <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($siswa as $item)
              <input type="hidden" name="pem_id" value="{{$item->id}}">
              <tbody>
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{$item->nama}}</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm" href="{{route('detail-siswa',$item->id)}}">
                                <i class="far fa-eye nav-icon"></i> &nbsp;view
                            </a>
                        </td>
                    </tr>
              </tbody>
              @endforeach
            </table>
          </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#Wali").addClass("active");
    </script>
@endsection