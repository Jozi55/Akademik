<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .container{
            margin-bottom: 4cm;
        }
        p{
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 14px;
        }
        .alamat{
            margin: 0cm;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 9px;
        }
        .des{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .table{
            border-top: 2px;
            border-top-color: black;
        }

        .table th{
            background-color:rgb(201, 200, 200);
        }
    </style>
    <title>Rapot {{$siswa->nama}}-{{$tahun->semester}}</title>
</head>
@php
    setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
@endphp
<body>
    <div class="container">
        <div class="row">
            <div class="alamat">
                <p>PEMERINTAH KABUPATEN BULELENG <br/>DINAS PENDIDIKAN KEPEMUDAAN DAN OLAHRAGA <br/> UNIT PELAKSANA TEKNIK KECAMATAN BANJAR DINAS BAINGIN <br/><STROng>SD NEGERI 3 DENCARIK</STROng>
                </p>
                <strong>Alamat : Banjar Dinas Baingin, Desa Dencarik, Kecamatan Banjar, Kabupaten Buleleng, Provinci Bali</strong>
            </div >
        </div>
        <hr style="border: 1px solid black;">
      <p>
           <strong>RAPOR AKHIR SEMESTER</strong>
      </p>
      <br> 
        <div class="row" style="width: 100%">
            <div class="col-sm-8">
                    <table style="float: left;width: 60%;">
                        <tr>
                            <td>Nama Siswa</td>
                            <td>:</td>
                            <td>{{$siswa->nama}}</td>
                        </tr>
                        <tr>
                            <td>NIS/NISN</td>
                            <td>:</td>
                            <td>{{$siswa->nis}} / {{$siswa->nisn}}</td>
                        </tr>
                        <tr>
                            <td>Nama Sekolah</td>
                            <td>:</td>
                            <td>SD Negeri 3 Dencarik</td>
                        </tr>
                    </table>
                
            </div>
            <div class="col-sm-8">
                <table style="float: left;width: 40%;">
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>{{$siswa->kelas->kelas}}</td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>{{$tahun->semester}}</td>
                    </tr>
                    <tr>
                        <td>Tahun Pelajaran</td>
                        <td>:</td>
                        <td>{{$tahun->tahun}}</td>
                    </tr>
                </table>
            </div>
            </div>
            <br>
            <div class="row" style="width: 100%">
                <strong>A. Kompetensi Sikap</strong>
                <br>
                <br>
                <table border="1" class="table table-striped">
                    <tr>
                        <th colspan="2" style="text-align:center;">Deskripsi</th>
                    </tr>
                    @foreach ($sikap as $item)
                        <tr>
                            <td style="text-align:center;width: 20%">Sikap Spiritual</td>
                            <td align="justify">{{$item->spiritual}}</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">Sikap Sosial</td>
                            <td align="justify" >{{$item->sosial}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

                <div class="row" style="width: 100%">
                    <strong>B. Kompetensi Pengetahuan dan Keterampilan</strong>
                    <br>
                    <br>
                    <table border="1" class="table table-striped">
                        <tr>
                            <th rowspan="2" style="width: 2%; vertical-align : middle;text-align:center;">No</th>
                            <th rowspan="2" style="width: 20%; vertical-align : middle;text-align:center;">Mata Pelajaran</th>
                            <th colspan="3" style="text-align:center;">Pengetahuan</th>
                            <th colspan="3" style="text-align:center;">Keterampilan</th>
                        </tr>
                        <tr>
                            <th>Nilai</th>
                            <th>Predikat</th>
                            <th>Deskripsi</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                            <th>Deskripsi</th>
                        </tr>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($rapot as $item)
                            @if ($item->mapel->kelompok == 'Wajib') 
                            <tr>
                                <td style="vertical-align : middle;text-align:center;">{{$no++}}</td>
                                <td style="vertical-align : middle;">{{$item->mapel->mapel }}</td>
                                <td style="text-align: center; vertical-align : middle;">{{$item->nilai_p}}</td>
                                <td style="text-align: center; vertical-align : middle;">{{$item->predikat_p}}</td>
                                <td align="justify" style="width:20%" class="des">{{$item->deskripsi_p}}</td>
                                <td style="text-align: center; vertical-align : middle;">{{$item->nilai_k}}</td>
                                <td style="text-align: center; vertical-align : middle;">{{$item->predikat_k}}</td>
                                <td align="justify" style="width:20%" class="des">{{$item->deskripsi_k}}</td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
                <br>
                <br>
                <br>
                <div class="row" style="width: 100%">
                    <strong>Muatan Lokal</strong>
                    <br>
                    <table border="1" class="table table-striped">
                        <tr>
                            <th rowspan="2" style="width: 2%; vertical-align : middle;text-align:center;">No</th>
                            <th rowspan="2" style="width: 20%; vertical-align : middle;text-align:center;">Mata Pelajaran</th>
                            <th colspan="3" style="text-align:center;">Pengetahuan</th>
                            <th colspan="3" style="text-align:center;">Keterampilan</th>
                        </tr>
                        <tr>
                            <th>Nilai</th>
                            <th>Predikat</th>
                            <th>Deskripsi</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                            <th>Deskripsi</th>
                        </tr>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($rapot as $item)
                            @if ($item->mapel->kelompok == 'Muatan Lokal') 
                            <tr>
                                <td style="vertical-align : middle;text-align:center;">{{$no++}}</td>
                                <td style="vertical-align : middle;">{{$item->mapel->mapel }}</td>
                                <td style="text-align: center; vertical-align : middle;">{{$item->nilai_p}}</td>
                                <td style="text-align: center; vertical-align : middle;">{{$item->predikat_p}}</td>
                                <td align="justify" style="width:20%" class="des">{{$item->deskripsi_p}}</td>
                                <td style="text-align: center; vertical-align : middle;">{{$item->nilai_k}}</td>
                                <td style="text-align: center; vertical-align : middle;">{{$item->predikat_k}}</td>
                                <td align="justify" style="width:20%" class="des">{{$item->deskripsi_k}}</td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
                <br>
                <br>
                <br>            
                <div class="row" style="width: 100%">
                    <strong>D. Kehadiran</strong>
                    <br>
                    <br>
                    <table border="1" class="table table-striped">
                        @php
                            $no = 1;
                        @endphp
                            <tr>
                                <td style="vertical-align : middle;text-align:center;">{{ $no++}}</td>
                                <td>Sakit</td>
                                <td>{{$sakit}} kali</td>
                            </tr>
                            <tr>
                                <td style="vertical-align : middle;text-align:center;">{{ $no++}}</td>
                                <td>Izin</td>
                                <td>{{$izin}} kali</td>
                            </tr>
                            <tr>
                                <td style="vertical-align : middle;text-align:center;">{{ $no++}}</td>
                                <td>Tanpa Keterangan</td>
                                <td>{{$tk}} kali</td>
                            </tr>
                    </table>
                </div>

            <div class="row" style="width: 100%">
                    <div class="col-sm-8">
                        <table style="float: left;width: 60%;">
                            <tr>
                                <td>Mengetahui</td>
                            </tr>
                            <tr>
                                <td>Orang Tua / Wali</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-8">
                        <table style="float: right;width: 30%;">
                            <tr>
                                <td>Dencarik, @php
                                    echo strftime("%d %B %Y");
                                @endphp</td>
                            </tr>
                            <tr>
                                <td>Guru Kelas,</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h4 style="color: white">a</h4>

                <div class="row" style="width: 100%">
                    <div class="col-sm-8">
                        <table style="float: left;width: 60%;">
                            <tr>
                                <td>{{$siswa->ayah}}</td>
                            </tr>
                        </table>
                    </div> 
                    <div class="col-sm-8">
                        <table style="float: right;width: 30%;">
                            <tr>
                                <td>{{$kelas->guru->nama}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row" style="width: 100%; float: right">
                    <div class="col-sm-8">
                        <table style="float: right; width: 31%;">
                            <td>
                                <td>NIP: </td>
                                <td>{{$kelas->guru->nip}}</td>
                            </td>
                        </table>
                    </div>
                </div>
            <br>
            <br>
                <div class="row">
                    <div style="text-align: center">
                        Mengetagui,<br>
                        Kepala Sekolah <br>
                        <br>
                        <br>
                        {{$kepala->nama}} <br>
                        NIP: {{$kepala->nip}}
                    </div >
                </div>
            </div>
        </div>
    </body>
</html>