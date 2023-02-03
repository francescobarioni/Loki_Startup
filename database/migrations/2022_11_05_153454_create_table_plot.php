<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE = 'plot';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(self::TABLE)) {
            Schema::create(self::TABLE, function (Blueprint $table) {
                $table->id();
                $table->string("plot_name")->nullable(false);
                $table->string("chat_room_name")->nullable(false);
                $table->string("vocal_room_name")->nullable(false);
                $table->unsignedBigInteger("user_id")->nullable(false);
                $table->foreign("user_id")->references("id")->on("users");
                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_plot');
    }
};
