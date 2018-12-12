<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'production';

    public function productionList()
    {
    	return $this->hasMany('Anodizado\ProductionList');
    }
}
