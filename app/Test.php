<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Test extends Model
{
    protected $fillable = ['subject','type'];
    
    protected $table = 'test';

    public $primaryKey = 'id';

    public $timestamps = true;

    public function serverhello()
    {
        return $this->hasMany('App\Serverhello');
    }
    public function ciphersperprotocol()
    {
        return $this->hasMany('App\Ciphersperprotocol');
    }
    public function handshakesimulation()
    {
        return $this->hasMany('App\Handshakesimulation');
    }
    public function offeredprotocols()
    {
        return $this->hasMany('App\Offeredprotocols');
    }
    public function securitybreaches()
    {
        return $this->hasMany('App\Securitybreaches');
    }
    public function securityHeaders()
    {
        return $this->hasMany('App\SecurityHeaders');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
