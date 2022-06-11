@extends('template.home')
@section('heading', 'Data Nilai Ulangan')
@section('page')
  <li class="breadcrumb-item active">Data Nilai Ulangan</li>
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
                      <th>Kelas</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($pembagian as $item)
              <tbody>
                    <tr>
                        <input type="hidden" name="pembagian_id" value="{{$item->id}}">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{$item->mapel->mapel}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route('ulangan-tambah',$item->id)}}">
                                <i class="nav-icon fas fa-folder-plus"></i> &nbsp;Input
                            </a>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".Modaledit{{$item->id}}" >
                                <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                            </button>
                        </td>
                    </tr>
              </tbody>
              @endforeach
            </table>
          </div>
    </div>
</div>

@foreach ($pembagian as $item)
<div class="modal fade Modaledit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <form id="form1"  method="get" action="{{route('ulangan-edit',$item->id)}}">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="col-md-6" style="float: left">
                                <select name="keterangan" class="a form-control">
                                    <option value="uh">Ulangan Harian</option>
                                    <option value="pts">Penilaian Tengah Semester</option>
                                    <option value="pas">Penilaian Akhit Semester</option>
                                    
                                </select>
                                
                            </div>
                            <div class="col-md-6" style="float: right">
                                <input type="number" name="ke" class="form-control" placeholder="Ke -">'
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <button class="form-control btn-primary">Edit</button>
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
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Ulangan").addClass("active");
    </script>
@endsection