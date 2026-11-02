<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'sch_settings';
    public $timestamps = false;
    protected $guarded = [];
}
