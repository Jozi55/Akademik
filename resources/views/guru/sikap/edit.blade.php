@extends('template.home')
@section('heading', 'Edit Data Sikap')
@section('page')
  <li class="breadcrumb-item active">Edit Data Sikap</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('sikap')}}" type="button" class="btn btn-default btn-sm" >
                    <i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali
                </a>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-12  table-responsive">
                    <form action="{{route('update-sikap')}}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="tahun" value="{{$tahun->id}}">
                        <input type="hidden" name="kelas" value="{{$kelas->id}}">
                        <table id="example3" class="table table-bordered table-striped table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>NO</th>
                                    <th >Nama</th>
                                    <th >Sikap Spiritual</th>
                                    <th >Sikap Sosial</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sikap as $item)
                                
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td style="width: 40%">
                                            <input type="hidden" name="sikap_id[]" value="{{$item->id}}">
                                            <input type="hidden" name="siswa_id[]" value="{{$item->siswa_id}}">{{$item->siswa->nama}}
                                        </td>
                                        <td>
                                            <textarea name="sp[]" id="" cols="40" rows="2">{{$item->spiritual}}</textarea>
                                        </td>
                                        <td>
                                            <textarea name="so[]" id="" cols="40" rows="2">{{$item->sosial}}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
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