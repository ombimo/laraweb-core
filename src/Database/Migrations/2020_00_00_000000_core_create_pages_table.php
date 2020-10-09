<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CoreCreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('judul')->nullable();
            $table->string('slug')->nullable();
            $table->string('cover')->nullable();
            $table->boolean('publish')->default(true);
            $table->boolean('rekomendasi')->default(false);
            $table->text('sinopsis')->nullable();
            $table->mediumText('isi')->nullable();
            $table->unsignedInteger('view')->default(0);
            $table->unsignedInteger('view_d')->default(0);
            $table->unsignedInteger('view_w')->default(0);
            $table->unsignedInteger('view_m')->default(0);
            $table->timestamps();
            $table->unique('slug');
        });

        DB::table('pages')->insert([[
            'slug' => 'tentang',
            'judul' => 'Tentang Kami',
            'isi' => 'Tentang Kami',
        ], [
            'slug' => 'sejarah',
            'judul' => 'Sejarah',
            'isi' => 'Sejarah',
        ], [
            'slug' => 'visi-misi',
            'judul' => 'Visi & Misi',
            'isi' => 'Visi Misi',
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
