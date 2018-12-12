<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Matriz extends Model
{
    protected $table = 'matriz';

    protected $fillable = [];

    public $timestamps = false;

    public function material()
    {
    	return $this->belongsTo('Anodizado\Material');
    }

    public function color()
    {
    	return $this->belongsTo('Anodizado\Color');
    }
}
