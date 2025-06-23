<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')
                  ->constrained()
                  ->onDelete('cascade');               // hapus foto otomatis saat undangan di-delete
            $table->string('path');                    // path file di storage
            $table->string('caption')->nullable();     // opsional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
