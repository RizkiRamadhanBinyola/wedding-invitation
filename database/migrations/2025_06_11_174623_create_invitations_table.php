<?php

// database/migrations/xxxx_xx_xx_create_invitations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('theme_id')->constrained()->onDelete('cascade');

            $table->string('slug')->unique();

            $table->string('nama_wanita');
            $table->string('nama_pria');
            $table->string('ortu_wanita');
            $table->string('ortu_pria');
            $table->string('anak_ke');
            $table->date('tanggal');
            $table->string('lokasi');

            $table->string('no_telp');
            $table->string('email');

            $table->string('waktu_akad');
            $table->string('waktu_resepsi');

            $table->string('no_rekening')->nullable();
            $table->string('instagram')->nullable();
            $table->string('musik')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
