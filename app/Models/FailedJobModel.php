<?php

namespace App\Models;

class FailedJobModel extends BaseModel {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "failed_jobs";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "uuid",
        "connection",
        "queue",
        "payload",
        "exception",
        "failed_at"
    ];
}
