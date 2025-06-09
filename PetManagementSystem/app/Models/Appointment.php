<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $dates = ['appointment_date'];

    public function pet() {
        return $this->belongsTo('App\Models\Pet');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    protected $guarded = [];
}
