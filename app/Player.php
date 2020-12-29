<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';

    protected $fillable = [
        'msisdn', 'status'
    ];

    public function subscriber() {
        return $this->hasOne('App\Subscriber', 'player_id');
    }
}
