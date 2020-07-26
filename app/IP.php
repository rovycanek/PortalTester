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
    public function formateSubject(String $subject){
        $this->ip=str_replace("https://", "", str_replace("www.", "", rtrim($subject,"/")));
   }
}
