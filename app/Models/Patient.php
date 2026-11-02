<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    public $timestamps = false;
    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return $this->patient_name;
    }
}
