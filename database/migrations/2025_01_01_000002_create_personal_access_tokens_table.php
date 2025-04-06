<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\PersonalAccessToken;

return new class extends Migration {
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->getTable(new PersonalAccessToken()), function (Blueprint $table) {
            $table->id();
            $table->morphs("tokenable");
            $table->string("name");
            $table->string("token", 64)->unique();
            $table->text("abilities")->nullable();
            $table->timestamp("last_used_at")->nullable();
            $table->timestamp("expires_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->getTable(new PersonalAccessToken()));
    }
};
