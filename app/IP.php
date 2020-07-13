<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    protected $table = 'ips';

    public $primaryKey = 'id';

    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
