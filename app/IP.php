<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    protected $table = 'i_p_s';

    public $primaryKey = 'id';

    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
