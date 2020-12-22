<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('no_peminjaman');
            $table->string('email')->index();
            $table->string('label_loker');
            $table->string('nama_inventory');
            $table->integer('jumlah');
            $table->string('pemilik');
            $table->string('deskripsi');
            $table->string('lokasi');
            $table->string('alasan_peminjaman');
            $table->string('status_peminjaman');
            $table->string('token')->nullable();
            $table->string('token_return')->nullable();
            $table->string('kondisi_inventory')->nullable();
            $table->boolean('notif_waktu_pengembalian')->nullable();
            $table->boolean('notif_belum_mengembalikan')->nullable();
            $table->timestamps();
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dateTime('dipinjam')->nullable()->after('created_at');
            $table->dateTime('dikembalikan')->nullable()->after('dipinjam');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
