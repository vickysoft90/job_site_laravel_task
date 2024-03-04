<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class JobLocation extends Model
{
    protected $table = 'job_location';
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
