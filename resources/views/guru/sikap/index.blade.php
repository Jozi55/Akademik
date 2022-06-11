@extends('template.home')
@section('heading', 'Data Sikap')
@section('page')
  <li class="breadcrumb-item active">Data Sikap</li>
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
                      <th>Kelas</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($kelas as $item)
              <input type="hidden" name="pem_id" value="{{$item->id}}">
              <tbody>
                    <tr>
                        <td class="text-center">{{$item->kelas->kelas}}</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm" href="{{route('tambah-sikap',$item->id)}}">
                                <i class="nav-icon fas fa-folder-plus"></i> &nbsp;Input
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{route('edit-sikap',$item->id)}}">
                                <i class="nav-icon far fa-edit"></i> &nbsp;Edit
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
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Sikap").addClass("active");
    </script>
@endsection