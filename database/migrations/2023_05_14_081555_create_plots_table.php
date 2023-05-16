<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('plots', function (Blueprint $table) {
            $table->id();
            $table->string('cadastral_number')->unique(); // уникальный идентификатор участка в Росреестре,
            $table->string('address'); // адрес
            $table->float('price'); // цена участка
            $table->float('area'); // площадь участка
            $table->json('data'); // ответ json от Росреестра
            $table->timestamp('expires_at'); // время истечения
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('plots');
    }
};
