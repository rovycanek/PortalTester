<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serverhello extends Model
{
    protected $table = 'serverhello';
    public $timestamps = false;
    public $primaryKey = 'id';
}
