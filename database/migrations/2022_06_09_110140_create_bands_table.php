<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // !!RUN MIGRATIONS!!
    public function up()
    {
        Schema::create('bands', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('band_name');
            $table->string('bio');
            $table->string('song');
            $table->string('photo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bands');
    }
};
