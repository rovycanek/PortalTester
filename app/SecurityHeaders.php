<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityHeaders extends Model
{
    protected $table = 'securityheaders';
    public $timestamps = false;
    public $primaryKey = 'id';
}
