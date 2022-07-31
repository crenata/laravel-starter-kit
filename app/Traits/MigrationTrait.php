<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

trait MigrationTrait {
    public function getTable(Model $model) {
        return $model->getTable();
    }

    public function timestamps(Blueprint $table) {
        $table->bigInteger("created_at")->nullable();
        $table->bigInteger("updated_at")->nullable();
    }

    public function softDeletes(Blueprint $table) {
        $table->bigInteger("deleted_at")->nullable();
    }
}
