<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('social')->nullable()->change();
            $table->string("avatar")->default("https://thumbs.dreamstime.com/b/default-avatar-photo-placeholder-profile-image-default-avatar-photo-placeholder-profile-image-eps-file-easy-to-edit-124557892.jpg")->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
