<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CoreCreatePageLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();

            $table->foreignId('page_id')
                  ->constrained()
                  ->onUpdate('no action')
                  ->onDelete('cascade');

            $table->string('locale', 5)->index();

            $table->string('judul')->nullable();
            $table->string('slug')->nullable();
            $table->string('cover')->nullable();
            $table->text('sinopsis')->nullable();
            $table->mediumText('isi')->nullable();
            $table->timestamps();
            $table->unique(['page_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_locales');
    }
}
