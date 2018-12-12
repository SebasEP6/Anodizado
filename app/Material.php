<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';

    public $timestamps = false;

    public function consume()
    {
    	return $this->hasMany('Anodizado\ConsumeList');
    }

    public function setQuantityAttribute($value)
    {
        if (!empty($value))
        {
            $this->attributes['quantity'] = $value;
        }
    }

    public function matriz()
    {
        return $this->hasMany('Anodizado\Matriz');
    }

    public function indexes()
    {
        return $this->hasMany('Anodizado\Index');
    }
}
