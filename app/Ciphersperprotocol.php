<?php

namespace App;
use App\Test;

use Illuminate\Database\Eloquent\Model;

class Ciphersperprotocol extends Model
{
    protected $table = 'ciphersperprotocol';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
