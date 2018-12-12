<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class ConsumeList extends Model
{
    protected $table = 'consume_lists';

    protected $fillable = ['material_id', 'quantity'];

    public function matItem()
    {
    	return $this->belongsTo('Anodizado\Material', 'material_id');
    }

    public function consume()
    {
    	return $this->belongsTo('Anodizado\Consume');
    }
}
