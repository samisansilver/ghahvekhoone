<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // نوع مکان (سفره‌خانه یا قهوه‌خانه)
            $table->text('description')->nullable(); // توضیحات
            $table->string('country')->nullable(); // کشور
            $table->string('city')->nullable(); // شهر
            $table->string('address')->nullable(); // آدرس
            $table->string('latitude')->nullable(); // عرض جغرافیایی
            $table->string('longitude')->nullable(); // طول جغرافیایی
            $table->string('phone')->nullable(); // شماره تماس
            $table->string('instagram')->nullable(); // وب‌سایت
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
        Schema::dropIfExists('places');
    }
};
