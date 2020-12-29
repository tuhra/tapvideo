<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'subscribers';

    protected $fillable = [
        'player_id', 'tranid', 'is_subscribed', 'valid_date', 'is_not_enough', 'is_new_user'
    ];

    public function player() {
        return $this->belongsTo('App\Player', 'id');
    }
}
