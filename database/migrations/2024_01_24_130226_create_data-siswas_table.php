<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_tingkat', function (Blueprint $table) {
            $table->id('id_tingkat');
            $table->string('nama_tingkat');
            $table->timestamps();
        });

        // Tabel tb_kelas
        Schema::create('tb_kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->string('wali_kelas');
            $table->string('kelas');
            $table->unsignedBigInteger('id_tingkat');
            $table->timestamps();

            $table->foreign('id_tingkat')->references('id_tingkat')->on('tb_tingkat')->onDelete('restrict');
        });

        // Tabel tb_siswa
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nama_siswa');
            $table->unsignedBigInteger('id_kelas');
            $table->string('nisn');
            $table->enum('jenis_kelamin', ['Perempuan', 'Laki-Laki']);
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas')->onDelete('cascade');
        });

        // Tabel tb_kehadiran
        Schema::create('tb_kehadiran', function (Blueprint $table) {
            $table->id('id_kehadiran');
            $table->string('kehadiran');
            $table->timestamps();
        });

        // Tabel tb_absensi
        Schema::create('tb_absensi', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_kehadiran');
            $table->date('tanggal');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('tb_siswa')->onDelete('restrict');
            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas')->onDelete('cascade');
            $table->foreign('id_kehadiran')->references('id_kehadiran')->on('tb_kehadiran')->onDelete('restrict');
        });

        //add data area
        \App\Models\tingkat::create([
            'nama_tingkat' => 'SMPIT Gema Nurani'
        ]);

        \App\Models\kelas::insert([
            [
                'wali_kelas' => 'Fachrudin Faidan',
                'kelas' => '9A',
                'id_tingkat' => '1',
                'id_kelas' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'wali_kelas' => 'Riska Ramdini',
                'kelas' => '9B',
                'id_tingkat' => '1',
                'id_kelas' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        \App\Models\data_siswa::insert([
            [
                'nama_siswa' => 'Ahnaf Samih Al Farisi',
                'id_kelas' => '1',
                'nisn' => '212207049',
                'jenis_kelamin' => 'Laki-Laki',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_siswa' => 'Abdurrahman Faiz',
                'id_kelas' => '1',
                'nisn' => '212207001',
                'jenis_kelamin' => 'Laki-Laki',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_siswa' => 'Abyantara Wibisana',
                'id_kelas' => '1',
                'nisn' => '212207002',
                'jenis_kelamin' => 'Laki-Laki',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //Akhwat 9B
            [
                'nama_siswa' => 'Adhwa Falihah',
                'id_kelas' => '2',
                'nisn' => '212207003',
                'jenis_kelamin' => 'Perempuan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_siswa' => 'Aileen Alethea Husen Titian',
                'id_kelas' => '2',
                'nisn' => '212207004',
                'jenis_kelamin' => 'Perempuan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_siswa' => 'Ainiya Azmi',
                'id_kelas' => '2',
                'nisn' => '212207005',
                'jenis_kelamin' => 'Perempuan',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        \App\Models\Kehadiran::insert([
            [
                'kehadiran' => 'Hadir',
                'id_kehadiran' => '1'
            ],
            [
                'kehadiran' => 'Sakit',
                'id_kehadiran' => '2'
            ],
            [
                'kehadiran' => 'Izin',
                'id_kehadiran' => '3'
            ],
            [
                'kehadiran' => 'Tanpa Keterangan',
                'id_kehadiran' => '4'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_siswa', function (Blueprint $table) {
            $table->dropIndex('idx_tb_siswa');
        });
        Schema::table('tb_kelas', function (Blueprint $table) {
            $table->dropIndex('idx_tb_kelas');
        });
        Schema::table('tb_absensi', function (Blueprint $table) {
            $table->dropIndex('idx_tb_absensi');
        });

        Schema::dropIfExists('tb_siswa');
        Schema::dropIfExists('tb_kelas');
        Schema::dropIfExists('tb_tingkat');
        Schema::dropIfExists('tb_kehadiran');
        Schema::dropIfExists('tb_absensi');
    }
};
