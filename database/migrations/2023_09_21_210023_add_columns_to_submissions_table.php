<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('why');
            $table->string('throtl_username');
            $table->boolean('active_vip');
            $table->string('vehicle_make');
            $table->string('vehicle_model');
            $table->integer('vehicle_year');
            $table->text('car_info');
            $table->text('dream_build');
            $table->text('ig_post');
            $table->text('fav_episode');
            $table->text('social_media');
            $table->boolean('terms_of_service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'email',
                'why',
                'throtl_username',
                'active_vip',
                'vehicle_make',
                'vehicle_model',
                'vehicle_year',
                'car_info',
                'dream_build',
                'ig_post',
                'fav_episode',
                'social_media',
                'terms_of_service',
            ]);
        });
    }
};
