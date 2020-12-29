<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriberLog extends Model
{
    protected $table = 'subscriber_logs';

    protected $fillable = [
        'player_id', 'event', 'channel_id'
    ];
}
