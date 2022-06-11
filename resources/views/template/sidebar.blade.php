<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @if (Auth::user()->role == "admin")
    <a href="/admin" class="brand-link" style="">
        <center><span class="brand-text font-weight-light">Sistem Akademik</span></center>
    </a>
    @else
    <a href="/home" class="brand-link" style="">
        <center><span class="brand-text font-weight-light">Sistem Akademik</span></center>
    </a>
    @endif
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->role == "admin")
                <li class="nav-item">
                    <a href="{{route('admin-home')}}" class="nav-link" id="AdminHome">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Dashboard Admin</p>
                    </a>
                </li>
                <li class="nav-item has-treeview" id="liMasterData">
                    <a href="#" class="nav-link" id="MasterData">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                            <a href="{{route('kepsek')}}" class="nav-link" id="DataKepala">
                                <i class="fas fa-user-graduate nav-icon"></i>
                                <p>Data Kepala Sekolah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('tahun')}}" class="nav-link" id="DataTahun">
                                <i class="far fa-clock nav-icon"></i>
                                <p>Data Tahun</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('mapel')}}" class="nav-link" id="DataMapel">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Data Mapel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('kelas')}}" class="nav-link" id="DataKelas">
                                <i class="fas fa-home nav-icon"></i>
                                <p>Data Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('guru')}}" class="nav-link" id="DataGuru">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Data Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('jadwal')}}" class="nav-link" id="DataJadwal">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <p>Data Jadwal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('siswa')}}" class="nav-link" id="DataSiswa">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin-nilai')}}" class="nav-link" id="AdminNilai">
                        <i class="fas fa-file-alt nav-icon"></i>
                        <p>Nilai Siswa</p>
                    </a>
                </li>
                {{-- Nilai Admin --}}
                @else
               
                    {{-- Area Guru --}}
                    {{-- Guru Wali Area --}}
                    <li class="nav-item has-treeview">
                        <a href="{{route('guru-home')}}" class="nav-link" id="AdminHome">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    @if (Auth::user()->role == "wali kelas")
                    <li class="nav-item">
                        <a href="{{route('list-siswa')}}" class="nav-link" id="Wali">
                            <i class="fas fa-chalkboard-teacher nav-icon"></i>
                            <p>Kelas</p>
                        </a>
                    </li>
                    @endif
                    
                    <li class="nav-item">
                        <a href="{{route('absensi')}}" class="nav-link" id="AbsenSiswa">
                            <i class="fas fa-calendar-check nav-icon"></i>
                            <p>Absen</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('guru-jadwal')}}" class="nav-link" id="JadwalGuru">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p>Jadwal</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview" id="liNilai">
                        <a href="#" class="nav-link" id="Nilai">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Nilai
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="{{route('kkm')}}" class="nav-link" id="KKM">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Nilai KKM</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('tugas')}}" class="nav-link" id="Tugas">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Nilai Tugas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('ulangan')}}" class="nav-link" id="Ulangan">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Nilai Ulangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('keterampilan')}}" class="nav-link" id="Keterampilan">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Nilai Keterampilan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('nilai')}}" class="nav-link" id="NA">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Nilai Akhir</p>
                                </a>
                            </li>
                            @if (Auth::user()->role == "wali kelas")
                            <li class="nav-item">
                                <a href="{{route('sikap')}}" class="nav-link" id="Sikap">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Nilai Sikap</p>
                                </a>
                            </li>
                        </ul>
                        <li class="nav-item">
                            <a href="{{route('raport')}}" class="nav-link" id="LA">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Laporan Nilai Akhir</p>
                            </a>
                        </li>
                        @endif
                    </li>
                    @endif
                </ul>
            </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>