<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Partial extends Model
{
    protected $table = 'partials';

    public function partialList()
    {
    	return $this->hasMany('Anodizado\PartialList');
    }
}
