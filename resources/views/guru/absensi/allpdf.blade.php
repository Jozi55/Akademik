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
            font-size: 24px
        }
        table{
            border-top: 2px;
            border-top-color: black;
        }
        table th{
            background-color:rgb(201, 200, 200);
        }
    </style>
    <title>Absensi</title>
</head>
<body>
    <div class="container">
        <p><strong>Absensi Kelas</strong></p>
        <br>
    <div class="row">
        <div class="col-sm-8">
            <table style="float: left;width: 20%;">
                <tr>
                    <td>Kelas </td>
                    <td>: </td>
                    <td> {{$pembagian->kelas->kelas}}</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-8">
            <table style="float: right;width: 40%;">
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
    <br>
    <div>
        <div class="row">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th style="text-align: center">Tanggal</th>
                    <th style="text-align: center">Pertemuan</th>
                    <th style="text-align: center">Nama</th>
                    <th style="text-align: center">Keterangan</th>
                </tr>

            @foreach ($absensi as $item)
                    <tr >
                        <td>{{$item->tgl}}</td>
                        <td  style="text-align: center">{{$item->pertemuan }}</td>
                        <td>{{$item->siswa->nama }}</td>
                        <td style="text-align: center">{{$item->keterangan}}</td>
                    </tr>            
            @endforeach
            </table>
        </div>
    </div>
</div>

</body>
</html>