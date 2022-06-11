<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        p{
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 24px;
        }
        table{
            font-size: 11px;
        }
    </style>
    <title>Jadwal</title>
</head>
<body>
    <div class="container">
        <p><strong>Jadwal Pelajaran</strong></p>
        <br>
    <div class="row">
        <div>
            <table>
                <tr>
                    <td>Kelas </td>
                    <td>: </td>
                    <td> {{$wali->kelas->kelas}}</td>
                </tr>
                <tr>
                    <td>Wali </td>
                    <td>: </td>
                    <td> {{$wali->guru->nama}}</td>
                </tr>
                <tr>
                    <td>Tahun Ajaran </td>
                    <td>: </td>
                    <td> {{$tahun->tahun}} - {{$tahun->semester}}</td>
                </tr>
            </table>
        </div>
        <hr style="border: 1px solid black;">
    </div>
    <br>
    <div>
        <div class="row">
                
                 {{-- Snin --}}
                 <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th style="text-align: center">Hari</th>
                        <th style="text-align: center">Jam</th>
                        <th style="text-align: center">Mapel</th>
                        <th style="text-align: center">Guru</th>
                    </tr>
                    @foreach ($jadwal as $item)
                        @if ($item->hari == "Senin")
                        <tr>
                            <td>{{$item->hari}}</td>
                            <td>{{$item->jam}}</td>
                            <td>{{$item->mapel->mapel}}</td>
                            @if ($item->guru_id == NULL)
                            <td> - </td>
                            @else
                            <td>{{$item->guru->nama}}</td>
                            @endif
                        </tr>         
                        @endif         
                    @endforeach
                </table>         
                
                {{-- Selasa --}}
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th style="text-align: center">Hari</th>
                        <th style="text-align: center">Jam</th>
                        <th style="text-align: center">Mapel</th>
                        <th style="text-align: center">Guru</th>
                    </tr>
                    @foreach ($jadwal as $item)
                        @if ($item->hari == "Selasa")
                        <tr>
                            <td>{{$item->hari}}</td>
                            <td>{{$item->jam}}</td>
                            <td>{{$item->mapel->mapel}}</td>                            
                            @if ($item->guru_id == NULL)
                            <td> - </td>
                            @else
                            <td>{{$item->guru->nama}}</td>
                            @endif
                        </tr>         
                        @endif         
                    @endforeach
                </table>      

                {{-- Rabu --}}
                 <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th style="text-align: center">Hari</th>
                        <th style="text-align: center">Jam</th>
                        <th style="text-align: center">Mapel</th>
                        <th style="text-align: center">Guru</th>
                    </tr>
                    @foreach ($jadwal as $item)
                        @if ($item->hari == "Rabu")
                        <tr>
                            <td>{{$item->hari}}</td>
                            <td>{{$item->jam}}</td>
                            <td>{{$item->mapel->mapel}}</td>                            
                            @if ($item->guru_id == NULL)
                            <td> - </td>
                            @else
                            <td>{{$item->guru->nama}}</td>
                            @endif
                        </tr>         
                        @endif         
                    @endforeach
                </table>      

                {{-- KAmis --}}
                 <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th style="text-align: center">Hari</th>
                        <th style="text-align: center">Jam</th>
                        <th style="text-align: center">Mapel</th>
                        <th style="text-align: center">Guru</th>
                    </tr>
                    @foreach ($jadwal as $item)
                        @if ($item->hari == "Kamis")
                        <tr>
                            <td>{{$item->hari}}</td>
                            <td>{{$item->jam}}</td>
                            <td>{{$item->mapel->mapel}}</td>                            
                            @if ($item->guru_id == NULL)
                            <td> - </td>
                            @else
                            <td>{{$item->guru->nama}}</td>
                            @endif
                        </tr>         
                        @endif         
                    @endforeach
                </table>      

                 {{-- Jumat --}}
                 <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th style="text-align: center">Hari</th>
                        <th style="text-align: center">Jam</th>
                        <th style="text-align: center">Mapel</th>
                        <th style="text-align: center">Guru</th>
                    </tr>
                    @foreach ($jadwal as $item)
                        @if ($item->hari == "Jumat")
                        <tr>
                            <td>{{$item->hari}}</td>
                            <td>{{$item->jam}}</td>
                            <td>{{$item->mapel->mapel}}</td>                            
                            @if ($item->guru_id == NULL)
                            <td> - </td>
                            @else
                            <td>{{$item->guru->nama}}</td>
                            @endif
                        </tr>         
                        @endif         
                    @endforeach
                </table>   
                
                 {{-- Sabtu --}}
                 <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th style="text-align: center">Hari</th>
                        <th style="text-align: center">Jam</th>
                        <th style="text-align: center">Mapel</th>
                        <th style="text-align: center">Guru</th>
                    </tr>
                    @foreach ($jadwal as $item)
                        @if ($item->hari == "Sabtu")
                        <tr>
                            <td>{{$item->hari}}</td>
                            <td>{{$item->jam}}</td>
                            <td>{{$item->mapel->mapel}}</td>                            
                            @if ($item->guru_id == NULL)
                            <td> - </td>
                            @else
                            <td>{{$item->guru->nama}}</td>
                            @endif
                        </tr>         
                        @endif         
                    @endforeach
                </table>      
        </div>
    </div>
</div>

</body>
</html>