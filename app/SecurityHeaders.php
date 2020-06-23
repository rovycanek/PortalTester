<?php

namespace App;
use App\Test;

use Illuminate\Database\Eloquent\Model;

class SecurityHeaders extends Model
{
    protected $table = 'securityheaders';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
