<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CoreCreatePageSegmentLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_segment_locales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('segment_id')
                  ->constrained('page_segments')
                  ->onUpdate('no action')
                  ->onDelete('cascade');

            $table->string('locale', 5)->index();
            $table->text('value')->nullable();
            $table->timestamps();
            $table->unique(['segment_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_segment_locales');
    }
}
