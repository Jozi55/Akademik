@extends('template.home')
@section('heading', 'Profile')
@section('page')
  <li class="breadcrumb-item active">Profile</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover text-center">
              <thead>
                  <tr>
                      <th>No.</th>
                      <th>NAMA</th>
                      <th>Email</th>
                      <th>Pilihan</th>
                  </tr>
              </thead>
              @foreach ($user as $item)
              <tbody>
                <td>{{ $loop->iteration }}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->email}}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ModalPass{{$item->id}}">
                        <i class="fas fa-key"></i>&nbsp; Edit Password
                    </button>
                </td>
              </tbody>
              @endforeach
            </table>
          </div>
    </div>
</div>


<!-- large modal edit-->

@foreach ($user as $item)
    
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
          <form action="{{route('admin-password',$item->id)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
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
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> &nbsp; Simpan</button>
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