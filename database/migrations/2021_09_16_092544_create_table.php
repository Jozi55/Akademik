<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahuns', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 20);
            $table->string('semester', 20);
            $table->timestamps();
        });
        
        Schema::create('kepalas', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('nama', 30);
            $table->string('status', 30);
            $table->timestamps();
        });

        
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->nullable();
            $table->string('nama', 30);
            $table->string('status', 20);
            $table->unsignedBigInteger('user_id')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('kelases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kelas');
            $table->timestamps();

        });

        Schema::create('walis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();

            $table->foreign('Kelas_id')->references('id')->on('kelases');
            $table->foreign('guru_id')->references('id')->on('gurus');

        });

        Schema::create('mapels', function (Blueprint $table) {
            $table->string('kode', 8)->primary();
            $table->string('nama', 20);
            $table->string('mapel', 55);
            $table->string('kelompok', 20);

            $table->timestamps();
            
        });

        Schema::create('pembagians', function (Blueprint $table) {
            $table->id();
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            $table->foreign('mapel_kode')->references('kode')->on('mapels');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
            $table->foreign('guru_id')->references('id')->on('gurus');
            $table->foreign('tahun_id')->references('id')->on('tahuns');

        });

        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('hari',10);
            $table->time('jam');
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            $table->foreign('mapel_kode')->references('kode')->on('mapels');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
            $table->foreign('guru_id')->references('id')->on('gurus');
            $table->foreign('tahun_id')->references('id')->on('tahuns');
        });


        Schema::create('kkms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kkm');
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            $table->foreign('tahun_id')->references('id')->on('tahuns');
            $table->foreign('mapel_kode')->references('kode')->on('mapels');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
        });

        Schema::create('predikats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('a');
            $table->bigInteger('b');
            $table->bigInteger('c');
            $table->bigInteger('d');
            $table->text('dpa');
            $table->text('dpb');
            $table->text('dpc');
            $table->text('dpd');
            $table->text('dka');
            $table->text('dkb');
            $table->text('dkc');
            $table->text('dkd');
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            $table->foreign('tahun_id')->references('id')->on('tahuns');
            $table->foreign('mapel_kode')->references('kode')->on('mapels');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
        });

        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 12)->nullable();
            $table->string('nis', 12)->nullable();
            $table->string('nama', 50);
            $table->string('tmp', 20);
            $table->date('tgl');
            $table->string('jk', 15);
            $table->string('agama',15);
            $table->text('alamat');
            $table->string('ayah', 30);
            $table->string('ibu', 30);
            $table->string('tlp', 13);
            $table->string('status', 15);
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();

            $table->foreign('Kelas_id')->references('id')->on('kelases');
        });

        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->bigInteger('pertemuan');
            $table->string('keterangan', 20);
            $table->unsignedBigInteger('siswa_id');
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            $table->foreign('tahun_id')->references('id')->on('tahuns');
            $table->foreign('kelas_id')->references('id')->on('kelases');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('mapel_kode')->references('kode')->on('mapels');
        });

        Schema::create('tugases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ke');
            $table->bigInteger('nilai');
            $table->unsignedBigInteger('siswa_id');
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            $table->foreign('tahun_id')->references('id')->on('tahuns');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('mapel_kode')->references('kode')->on('mapels');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
        });


        Schema::create('ulangans', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan',50);
            $table->bigInteger('ke')->nullable();
            $table->bigInteger('nilai');
            $table->unsignedBigInteger('siswa_id');
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            $table->foreign('tahun_id')->references('id')->on('tahuns');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('mapel_kode')->references('kode')->on('mapels');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
        });

        Schema::create('keterampilans', function (Blueprint $table) {
            $table->id();
            $table->string('kd',5);
            $table->bigInteger('nilai');
            $table->unsignedBigInteger('siswa_id');
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            $table->foreign('tahun_id')->references('id')->on('tahuns');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('mapel_kode')->references('kode')->on('mapels');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
        });

        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('t_uh')->nullable();
            $table->bigInteger('t_tugas')->nullable();
            $table->bigInteger('t_pts')->nullable();
            $table->bigInteger('t_pas')->nullable();
            $table->bigInteger('t_nilai')->nullable();
            $table->bigInteger('n_akhir')->nullable();
            $table->bigInteger('k_nilai')->nullable();
            $table->bigInteger('k_akhir')->nullable();
            
            $table->unsignedBigInteger('siswa_id');
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');;
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('mapel_kode')->references('kode')->on('mapels');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
            $table->foreign('tahun_id')->references('id')->on('tahuns');
        });

        Schema::create('sikaps', function (Blueprint $table) {
            $table->id();
            $table->text('spiritual');
            $table->text('sosial');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            $table->foreign('tahun_id')->references('id')->on('tahuns');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
        });

        Schema::create('raports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nilai_p')->nullable();
            $table->string('predikat_p',2)->nullable();
            $table->text('deskripsi_p')->nullable();
            $table->bigInteger('nilai_k')->nullable();
            $table->string('predikat_k',2)->nullable();
            $table->text('deskripsi_k')->nullable();
            $table->unsignedBigInteger('siswa_id');
            $table->string('mapel_kode', 8);
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('kkm_id');
            $table->unsignedBigInteger('tahun_id');
            $table->timestamps();

            
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('mapel_kode')->references('kode')->on('mapels');
            $table->foreign('Kelas_id')->references('id')->on('kelases');
            $table->foreign('kkm_id')->references('id')->on('kkms');
            $table->foreign('tahun_id')->references('id')->on('tahuns');

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahuns');
        Schema::dropIfExists('agamas');
        Schema::dropIfExists('kepalas');
        Schema::dropIfExists('mapels');
        Schema::dropIfExists('pembagians');
        Schema::dropIfExists('kelases');
        Schema::dropIfExists('jadwals');
        Schema::dropIfExists('kkms');
        Schema::dropIfExists('gurus');
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('absens');
        Schema::dropIfExists('kkms');
        Schema::dropIfExists('predikats');
        Schema::dropIfExists('walis');
        Schema::dropIfExists('absensis');
        Schema::dropIfExists('tugases');
        Schema::dropIfExists('ulangans');
        Schema::dropIfExists('keterampilans');
        Schema::dropIfExists('nilais');
        Schema::dropIfExists('sikaps');
        Schema::dropIfExists('raports');
    }
}
