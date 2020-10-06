<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('photoable_type'); // Typ obiektu do ktorego nalezy fotografia uzytkownik obiekt turystyczny pokoj itp
            $table->bigInteger('photoable_id'); // musimy te obiekty znalezc po id
            $table->string('path'); // sciezka obrazka
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
