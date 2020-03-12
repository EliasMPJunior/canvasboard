<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeOfCanvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('mysql')->hasTable('type_of_canvas') === false)
        {
        Schema::connection('mysql')->create('type_of_canvas', function (Blueprint $table) {
            $table->string('uuid')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('content');
            $table->timestamps();
	});
	}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('type_of_canvas');
    }
}
