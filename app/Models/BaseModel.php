<?php

namespace App\Models;

use App\Traits\SoftDeletesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
    use HasFactory, SoftDeletesTrait;

    public function save(array $options = []) {
        $time = time();
        if (!$this->exists) $this->attributes[$this->getCreatedAtColumn()] = $time;
        $this->attributes[$this->getUpdatedAtColumn()] = $time;
        return parent::save($options);
    }
}
