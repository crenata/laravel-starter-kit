<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\SoftDeletesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;

class BaseAuthenticatableModel extends Authenticatable {
    use HasApiTokens, HasFactory, HasPushSubscriptions, Notifiable, SoftDeletesTrait;

    public function save(array $options = []) {
        $time = time();
        if (!$this->exists) $this->attributes[$this->getCreatedAtColumn()] = $time;
        $this->attributes[$this->getUpdatedAtColumn()] = $time;
        return parent::save($options);
    }
}
