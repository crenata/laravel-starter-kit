<?php

use App\Models\FailedJobModel;
use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->getTable(new FailedJobModel()), function (Blueprint $table) {
            $table->id();
            $table->string("uuid")->unique();
            $table->text("connection");
            $table->text("queue");
            $table->longText("payload");
            $table->longText("exception");
            $table->bigInteger("failed_at")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->getTable(new FailedJobModel()));
    }
};
