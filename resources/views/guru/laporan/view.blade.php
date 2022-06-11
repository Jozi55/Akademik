@extends('template.home')
@section('heading', 'Nilai Siswa')
@section('page')
  <li class="breadcrumb-item active">Nilai Siswa</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a type="button" class="btn btn-default btn-sm" href="{{route('raport')}}">
                    <i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali
                </a>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example3" class="table">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2">Mata Pelajaran</th>
                        <th colspan="6">Nilai</th>
                    </tr>
                    <tr>
                        <th>Tugas</th>
                        <th>Ulangan</th>
                        <th>Penilaian Setengah Semester</th>
                        <th>Penilaian Akhih Semester</th>
                        <th>Nilai Akhir Pengetahuan</th>
                        <th>Keterampilan</th>
                    </tr>
                </thead>
                @foreach ($nilai as $item)
                    
                <tbody class="text-center">
                    <tr>
                        <td>{{$item->mapel->mapel}}</td>
                        <td>{{$item->t_tugas}}</td>
                        <td>{{$item->t_uh}}</td>
                        <td>{{$item->t_pts}}</td>
                        <td>{{$item->t_pas}}</td>
                        <td>{{$item->n_akhir}}</td>
                        <td>{{$item->k_akhir}}</td>
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
        $("#LA").addClass("active");
    </script>
@endsection