<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            @foreach ($kehadiran as $item)
                <th>{{$item->pertemuan}}</th>
            @endforeach
        </tr>
        <tr>

            @foreach ($absensi as $item)

            <th>{{$item->keterangan}}</th>

            @endforeach
        </tr>

    </table>
</body>
</html>