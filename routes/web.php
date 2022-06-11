<?php

use App\Http\Controllers\AbsenControllers;
use App\Http\Controllers\AdminControllers;
use App\Http\Controllers\EkstraControllers;
use App\Http\Controllers\GuruControllers;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\JadwalControllers;
use App\Http\Controllers\KelasControllers;
use App\Http\Controllers\KepsekControllers;
use App\Http\Controllers\KesehatanControllers;
use App\Http\Controllers\KeterampilanControllers;
use App\Http\Controllers\KkmControllers;
use App\Http\Controllers\LaporanControllers;
use App\Http\Controllers\LoginControllers;
use App\Http\Controllers\MapelControllers;
use App\Http\Controllers\NilaiControllers;
use App\Http\Controllers\PembagianControllers;
use App\Http\Controllers\SikapControllers;
use App\Http\Controllers\SiswaControllers;
use App\Http\Controllers\TahunControllers;
use App\Http\Controllers\TugasControllers;
use App\Http\Controllers\UlanganControllers;
use App\Models\Ekstrakulikuler;
use App\Models\Nilai;
use App\Models\Ulangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login',[LoginControllers::class,'index'])->name('login');
Route::post('/postlogin',[LoginControllers::class,'postLogin'])->name('postlogin');

Route::get('/absensi/test',[AbsenControllers::class,'test'])->name('absensi');

Route::middleware(['auth'])->group(function () {
    Route::get('/',function(){
        if (Auth::user()->role == 'admin') {
            return redirect('/admin');
        }else{
            return redirect('/home');
        }
    });
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin',[HomeControllers::class,'admin_index'])->name('admin-home');
        Route::get('/guru',[GuruControllers::class,'index'])->name('guru');
        Route::get('/guru/cari',[GuruControllers::class,'cari'])->name('guru-cari');
        Route::post('/guru/simpan',[GuruControllers::class,'simpan'])->name('simpan-guru');
        Route::patch('/guru/update/{id}',[GuruControllers::class,'update'])->name('update-guru');
        Route::patch('/guru/password',[GuruControllers::class,'password'])->name('password-guru');
        Route::get('/tahun',[TahunControllers::class,'index'])->name('tahun');
        Route::post('/tahun/simpan',[TahunControllers::class,'simpan'])->name('simpan');
        Route::patch('/tahun/update/{id}',[TahunControllers::class,'update'])->name('update-tahun');

        Route::get('/kepsek',[KepsekControllers::class,'index'])->name('kepsek');
        Route::post('/kepsek/simpan',[KepsekControllers::class,'simpan'])->name('simpan-kepsek');
        Route::patch('/kepsek/edit/{id}',[KepsekControllers::class,'edit'])->name('update-kepsek');
        Route::get('/kepsek/cari',[KepsekControllers::class,'cari'])->name('kepala-cari');

        Route::get('/mapel',[MapelControllers::class,'index'])->name('mapel');
        Route::get('/mapel/cari',[MapelControllers::class,'cari'])->name('mapel-cari');
        Route::post('/mapel/simpan',[MapelControllers::class,'simpan'])->name('simpan-mapel');
        Route::patch('/mapel/update/{kode}',[MapelControllers::class,'update'])->name('update-mapel');
        Route::delete('/mapel/hapus/{kode}',[MapelControllers::class,'hapus'])->name('hapus-mapel');

        Route::get('/kelas',[KelasControllers::class,'index'])->name('kelas');
        Route::post('/kelas/simpan',[KelasControllers::class,'simpan'])->name('simpan-kelas');
        Route::patch('/kelas/update/{id}',[KelasControllers::class,'update'])->name('update-kelas');
        Route::delete('/kelas/hapus/{id}',[KelasControllers::class,'hapus'])->name('hapus-kelas');

        Route::get('/jadwal',[JadwalControllers::class,'index'])->name('jadwal');
        Route::get('/jadwal/cari',[JadwalControllers::class,'cari'])->name('cari');
        Route::get('/jadwal/tambah/cari',[JadwalControllers::class,'caritambah'])->name('cari-tambah');

        Route::get('/jadwal/tambah',[JadwalControllers::class,'tambah'])->name('tambah-jadwal');
        Route::get('/jadwal/edit/{id}',[JadwalControllers::class,'edit'])->name('edit-jadwal');

        Route::patch('/jadwal/update/{id}',[JadwalControllers::class,'update'])->name('update-jadwal');
        Route::post('/jadwal/simpan',[JadwalControllers::class,'simpan'])->name('simpan-jadwal');
        Route::delete('/jadwal/delete/{id}',[JadwalControllers::class,'hapus'])->name('hapus-jadwal');
        Route::delete('/jadwal/hapus',[JadwalControllers::class,'hapusAll'])->name('hapusAll-jadwal');
        Route::get('/jadwal/view',[JadwalControllers::class,'pdf'])->name('view-jadwal');
        
        Route::get('/siswa',[SiswaControllers::class,'index'])->name('siswa');
        Route::get('/siswa/cari',[SiswaControllers::class,'cari'])->name('siswa-cari');
        Route::get('/siswa/tambah',[SiswaControllers::class,'tambah'])->name('siswa-tambah');
        Route::post('/siswa/simpan',[SiswaControllers::class,'simpan'])->name('siswa-simpan');
        Route::get('/siswa/edit/{id}',[SiswaControllers::class,'edit'])->name('siswa-edit');
        Route::patch('/siswa/update/{id}',[SiswaControllers::class,'update'])->name('siswa-update');
        Route::delete('/siswa/hapus/{id}',[SiswaControllers::class,'hapus'])->name('siswa-hapus');

        Route::get('/admin/nilai',[LaporanControllers::class,'admin_index'])->name('admin-nilai');
        Route::get('/admin/nilai/siswa/{id}',[LaporanControllers::class,'siswa'])->name('siswa-nilai');
        Route::get('/admin/nilai/siswa/{id}/cari',[LaporanControllers::class,'cari'])->name('admin-siswa-cari');
        Route::get('/admin/nilai/siswa/{id}/view',[LaporanControllers::class,'admin_nilai'])->name('admin-view-nilai');
        Route::get('/admin/nilai/siswa/{id}/cetak',[LaporanControllers::class,'admin_cetak'])->name('admin-cetak-nilai');

        Route::get('/profile',[AdminControllers::class,'index'])->name('admin-profile');
        Route::patch('/profile/{id}/password',[AdminControllers::class,'password'])->name('admin-password');
        Route::patch('/profile/{id}/email',[AdminControllers::class,'email'])->name('admin-email');
    });


    Route::middleware(['guru'])->group(function () {
        Route::get('/home', [HomeControllers::class,'guru_index'])->name('guru-home');
        
        Route::get('/absensi',[AbsenControllers::class,'index'])->name('absensi');
        Route::get('/absensi/tambah/{id}',[AbsenControllers::class,'tambah'])->name('absensi-tambah');
        Route::get('/absensi/view/{id}',[AbsenControllers::class,'view'])->name('absensi-view');
        Route::get('/absensi/view/{id}/cari',[AbsenControllers::class,'cari'])->name('absensi-viewcari');
        Route::get('/absensi/view/{id}/pdf',[AbsenControllers::class,'pdf'])->name('absensi-viewpdf');
        Route::get('/absensi/view/{id}/allpdf',[AbsenControllers::class,'allpdf'])->name('absensi-allpdf');


        Route::post('/absensi/simpan',[AbsenControllers::class,'simpan'])->name('simpan-absensi');
        Route::get('/absensi/edit/{id}',[AbsenControllers::class,'edit'])->name('absensi-edit');
        Route::patch('/absensi/update',[AbsenControllers::class,'update'])->name('absensi-update');

        Route::get('/guru/jadwal',[JadwalControllers::class,'gurujadwal'])->name('guru-jadwal');
        Route::get('/guru/jadwal/cari',[JadwalControllers::class,'gurucari'])->name('gcari');

        Route::get('wali/kelas',[KelasControllers::class,'list'])->name('list-siswa');
        Route::get('wali/kelas/{id}',[KelasControllers::class,'detail'])->name('detail-siswa');

        Route::get('/ulangan',[UlanganControllers::class,'index'])->name('ulangan');
        Route::get('/ulangan/tambah/{id}',[UlanganControllers::class,'tambah'])->name('ulangan-tambah');
        Route::post('/ulangan/simpan',[UlanganControllers::class,'simpan'])->name('ulangan-simpan');
        Route::get('/ulangan/edit/{id}',[UlanganControllers::class,'edit'])->name('ulangan-edit');
        Route::patch('/ulangan/update',[UlanganControllers::class,'update'])->name('ulangan-update');
        Route::post('/ulangan/simpantambah',[UlanganControllers::class,'simpanTambah'])->name('ulangan-simpan-tambah');


        Route::get('/kkm',[KkmControllers::class,'index'])->name('kkm');
        Route::get('/kkm/tambah/{id}',[KkmControllers::class,'tambah'])->name('kkm-tambah');
        Route::post('/kkm/simpan',[KkmControllers::class,'simpan'])->name('kkm-simpan');
        Route::get('/kkm/edit/{id}',[KkmControllers::class,'edit'])->name('edit-kkm');
        Route::patch('/kkm/update',[KkmControllers::class,'update'])->name('update-kkm');

        Route::get('/tugas',[TugasControllers::class,'index'])->name('tugas');
        Route::get('/tugas/tambah/{id}',[TugasControllers::class,'tambah'])->name('tambah-tugas');
        Route::post('/tugas/simpan',[TugasControllers::class,'simpan'])->name('simpan-tugas');
        Route::get('/tugas/edit/{id}',[TugasControllers::class,'edit'])->name('edit-tugas');
        Route::patch('/tugas/update',[TugasControllers::class,'update'])->name('update-tugas');
        Route::post('/tugas/simpantambah',[TugasControllers::class,'simpanTambah'])->name('simpan-tugas-tambah');


        Route::get('/keterampilan',[KeterampilanControllers::class,'index'])->name('keterampilan');
        Route::get('/keterampilan/tambah/{id}',[KeterampilanControllers::class,'tambah'])->name('tambah-keterampilan');
        Route::post('/keterampilan/simpan',[KeterampilanControllers::class,'simpan'])->name('simpan-keterampilan');
        Route::get('/keterampilan/edit/{id}',[KeterampilanControllers::class,'edit'])->name('edit-keterampilan');
        Route::patch('/keterampilan/update',[KeterampilanControllers::class,'update'])->name('update-keterampilan');

        Route::get('/sikap',[SikapControllers::class,'index'])->name('sikap');
        Route::get('/sikap/tambah/{id}',[SikapControllers::class,'tambah'])->name('tambah-sikap');
        Route::post('/sikap/simpan',[SikapControllers::class,'simpan'])->name('simpan-sikap');
        Route::get('/sikap/edit/{id}',[SikapControllers::class,'edit'])->name('edit-sikap');
        Route::patch('/sikap/update',[SikapControllers::class,'update'])->name('update-sikap');
        
        Route::get('/raport',[LaporanControllers::class,'index'])->name('raport');
        Route::get('/raport/view/{siswa_id}',[LaporanControllers::class,'view'])->name('view-raport');
        Route::get('/rapot/cetak/{siswa_id}',[LaporanControllers::class,'cetak'])->name('cetak-raport');

        Route::get('/nilai',[NilaiControllers::class,'index'])->name('nilai');
        Route::get('/nilai/guru/view/{kelas_id}',[NilaiControllers::class,'guruNilai'])->name('guru-nilai');

      });

      Route::get('/logout',[LoginControllers::class,'logout'])->name('logout');

      Route::get('/test',[UlanganControllers::class,'test']);

});
















