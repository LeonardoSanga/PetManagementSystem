<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $dates = ['birth_date'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function appointments() {
        return $this->hasMany('App\Models\Appointment');
    }

    protected $guarded = [];
}
