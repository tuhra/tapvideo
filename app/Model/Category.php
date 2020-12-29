<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

    protected $fillable = ['name', 'media_id'];

    public function media()
    {
        return $this->belongsTo('App\Model\Media', 'media_id');
    }
}
