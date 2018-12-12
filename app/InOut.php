<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class InOut extends Model
{
    protected $table = 'in_out';

    protected $fillable = ['type'];

    public function putsList()
    {
    	return $this->hasMany('Anodizado\InOutList');
    }
}
