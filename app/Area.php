<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'code', 'description','ground_allowed','ground_not_allowed','path'
    ];

    public function polygons()
    {
        return $this->hasMany('App\Poligon');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
