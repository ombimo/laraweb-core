<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CoreCreatePageSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_segments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('page_id')->nullable()
                  ->constrained('pages')
                  ->onUpdate('no action')
                  ->onDelete('cascade');

            $table->string('name')->nullable();
            $table->text('value')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->unique(['page_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_segments');
    }
}
