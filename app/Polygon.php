<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polygon extends Model
{
    protected $fillable = [
        'code', 'path','area_id'
    ];

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
}
