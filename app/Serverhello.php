<?php

namespace App;
use App\Test;

use Illuminate\Database\Eloquent\Model;

class Serverhello extends Model
{
    protected $table = 'serverhello';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
