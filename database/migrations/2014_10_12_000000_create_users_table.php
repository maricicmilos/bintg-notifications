<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('role_id')
                ->constrained('roles')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('specialty_id')
                ->constrained('specialties')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('confirmation_code');
            $table->smallInteger('is_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
