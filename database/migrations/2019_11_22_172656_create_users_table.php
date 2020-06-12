<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\String_;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('sex')->nullable();
            $table->timestamp('birth_day')->nullable();
            $table->integer('age')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->string('reset_password_token')->unique()->nullable();
            $table->string('status', 16);
            $table->boolean('hide_workers')->default(false);
            $table->boolean('report_by_phone_w')->default(false);
            $table->boolean('report_by_email_w')->default(false);
            $table->boolean('hide_jobs')->default(false);
            $table->boolean('report_by_phone_j')->default(false);
            $table->boolean('report_by_email_j')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
