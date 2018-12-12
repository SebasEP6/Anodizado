<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Consume extends Model
{
    protected $table = 'consume';

    protected $fillable = ['quantity', 'material_id'];

    public function material()
    {
    	return $this->belongsTo('Anodizado\Material');
    }

    public function consumeList()
    {
    	return $this->hasMany('Anodizado\ConsumeList');
    }
}
