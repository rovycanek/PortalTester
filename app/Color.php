<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    public $primaryKey = 'id';

    public $timestamps = true;
}
