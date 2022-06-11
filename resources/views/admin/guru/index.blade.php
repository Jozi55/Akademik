@extends('template.home')
@section('heading', 'Data List Guru')
@section('page')
  <li class="breadcrumb-item active">Data List Guru</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".ModalBesar">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Guru
                </button>
            </h3>
        </div>

        
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <form action="{{route('guru-cari')}}" method="GET">
                <div class="row text-center">
                    <div class="col-md-2">
                        <label for="status" style="text-align: center">Status</label>
                        <select name="status" id="" class="form-control" onchange="this.form.submit();">
                            <option value="">-- Pilih Status --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>  
                    </div>
                </div>           
            </form>
            <table id="example3" class="table table-bordered table-striped table-hover">

              <thead class="text-center">
                  <tr>
                      <th>No.</th>
                      <th>NIP</th>
                      <th>NAMA</th>
                      <th>Email</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($guru as $item)

              <tbody>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>              
                    <input type="hidden" name="user_id" value="{{$item->user_id}}">
                    {{$item->nip}}
                </td>
                <td>{{$item->nama}}</td>
                <td>{{$item->user->email}}</td>
                <td class="text-center">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ModalEdit{{$item->id}}">
                        <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                    </button>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ModalPass{{$item->id}}"><i class="nav-icon fas fa-key"></i>&nbsp; Edit Password</button>
                </td>
              </tbody>
              @endforeach
            </table>
          </div>

    </div>
</div>

<!-- Extra large modal -->
<div class="modal fade  ModalBesar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data Guru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('simpan-guru')}}" method="post">
            @csrf
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="number" id="nip" name="nip" class="form-control form1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="nama" class="form-control form1" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control form1" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password-field" type="password" class="form-control" name="password">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>                    
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
          </form>
      </div>
      </div>
    </div>
  </div>

<!-- large modal edit-->
@foreach ($guru as $item)
<div class="modal fade  ModalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Edit Data Guru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('update-guru',$item->id)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <input type="hidden" name="user_id" value="{{$item->user_id}}">
            <input type="hidden" name="guru_id" value="{{$item->id}}">
            <div class="row text-center">
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="number" id="nip" name="nip" class="form-control" value="{{$item->nip}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="nama" class="form-control" value="{{$item->nama}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{$item->user->email}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="{{$item->status}}">{{$item->status}}</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
          </form>
      </div>
      </div>
    </div>
  </div>
@endforeach

@foreach ($guru as $item)
    
<div class="modal fade  ModalPass{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myEdit" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Edit Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{route('password-guru')}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <input type="hidden" name="user_id" value="{{$item->user_id}}">
            <div class="row text-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password-show" type="password" class="form-control" name="password">
                        <span toggle="#password-show" class="fa fa-fw fa-eye field-icon toggles-passwords"></span>                    
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
          </form>
      </div>
      </div>
    </div>
  </div>
@endforeach


@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataGuru").addClass("active");

        $(".toggle-password").click(function(){
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type","text");
            }else{
                input.attr("type","password")
            }
        });

        $(".toggles-passwords").click(function(){
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type","text");
            }else{
                input.attr("type","password")
            }
        });
        
    </script>
@endsection