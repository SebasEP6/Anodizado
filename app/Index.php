<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    protected $table = 'indexes';

    protected $fillable = [];

    public $timestamps = false;

    public function material()
    {
    	return $this->belongsTo('Anodizado\Material');
    }
}
