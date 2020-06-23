<?php

namespace App;
use App\Test;

use Illuminate\Database\Eloquent\Model;

class Securitybreaches extends Model
{
    protected $table = 'securitybreaches';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
