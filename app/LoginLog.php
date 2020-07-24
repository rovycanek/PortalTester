<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $table = 'loginlog';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
