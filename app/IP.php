<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    protected $table = 'i_p_s';

    public $primaryKey = 'id';

    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
