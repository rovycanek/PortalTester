<?php

namespace App;
use App\Test;

use Illuminate\Database\Eloquent\Model;

class Offeredprotocols extends Model
{
    protected $table = 'offeredprotocols';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
