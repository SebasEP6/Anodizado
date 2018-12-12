<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Aluminum extends Model
{
    protected $table = 'aluminum';

    protected $fillable = ['quantity', 'aGroup', 'pGroup'];

    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('Anodizado\Group');
    }

    public function puts()
    {
    	return $this->hasMany('Anodizado\InOutList');
    }

    public function prodItems()
    {
        return $this->hasMany('Anodizado\ProductionList');
    }

    public function partItems()
    {
        return $this->hasMany('Anodizado\PartialList');
    }

    public function setQuantityAttribute($value)
    {
        if (!empty($value))
        {
            $this->attributes['quantity'] = $value;
        }
    }

    public function setAGroupAttribute($value)
    {
        if (!empty($value))
        {
            $this->attributes['aGroup'] = $value;
        }
    }

    public function setPGroupAttribute($value)
    {
        if (!empty($value))
        {
            $this->attributes['pGroup'] = $value;
        }
    }
}
