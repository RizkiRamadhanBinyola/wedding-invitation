<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGreetingsTable extends Migration
{
    public function up()
    {
        Schema::create('greetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade'); // Terkait dengan undangan
            $table->string('nama_pengirim');
            $table->text('isi_ucapan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('greetings');
    }
}
