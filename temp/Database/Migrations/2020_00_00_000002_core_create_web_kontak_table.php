<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CoreCreateWebKontakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_kontak', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('value')->nullable();
            $table->string('icon_class')->nullable();
            $table->boolean('is_social_media')->default(0);
            $table->timestamps();
        });

        DB::table('web_kontak')->insert([[
            'name' => 'alamat',
            'value' => 'Alamat Perusahaan',
            'is_social_media' => 0,
            'icon_class' => '',
        ], [
            'name' => 'no_telp',
            'value' => '+62 876543 xxx',
            'is_social_media' => 0,
            'icon_class' => '',
        ], [
            'name' => 'email',
            'value' => 'halo@example.com',
            'is_social_media' => 0,
            'icon_class' => '',
        ], [
            'name' => 'website',
            'value' => 'https://example.com',
            'is_social_media' => 0,
            'icon_class' => '',
        ], [
            'name' => 'instagram',
            'value' => 'https://instagram.com',
            'is_social_media' => 1,
            'icon_class' => '',
        ], [
            'name' => 'facebook',
            'value' => 'https://www.facebook.com',
            'is_social_media' => 1,
            'icon_class' => '',
        ], [
            'name' => 'youtube',
            'value' => 'https://youtube.com',
            'is_social_media' => 1,
            'icon_class' => '',
        ], ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_kontak');
    }
}
