<?php

use App\Models\PushSubscriptionModel;
use App\Traits\MigrationTrait;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::connection(config("webpush.database_connection"))->create($this->getTable(new PushSubscriptionModel()), function (Blueprint $table) {
            $table->id();
            $table->morphs("subscribable");
            $table->string("endpoint", 500)->unique();
            $table->string("public_key")->nullable();
            $table->string("auth_token")->nullable();
            $table->string("content_encoding")->nullable();
            $this->timestamps($table);
            $this->softDeletes($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::connection(config("webpush.database_connection"))->dropIfExists($this->getTable(new PushSubscriptionModel()));
    }
};