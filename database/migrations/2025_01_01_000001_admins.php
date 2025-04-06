<?php

use App\Models\AdminModel;
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
        Schema::create($this->getTable(new AdminModel()), function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->rememberToken();
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
        Schema::dropIfExists($this->getTable(new AdminModel()));
    }
};
