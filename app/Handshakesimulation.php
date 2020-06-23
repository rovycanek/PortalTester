<?php

namespace App;
use App\Test;

use Illuminate\Database\Eloquent\Model;

class Handshakesimulation extends Model
{
    protected $table = 'handshakesimulation';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
