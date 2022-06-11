<table>
    @php
        $i = 0;
    @endphp
        @foreach ($list as $item => $data)
        <tr>

            <td>{{$data[0]->mapel->mapel}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{route('tambah-tugas',$item)}}">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp;Input
                </a>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".ModalEdit{{$item}}" >
                    <i class="nav-icon far fa-edit"></i> &nbsp;Edit
                </button>
            </td>
        </tr>

        @endforeach
</table>