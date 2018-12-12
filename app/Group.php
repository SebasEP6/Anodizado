<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    public $timestamps = false;

    public function alItem()
    {
    	return $this->hasMany('Anodizado\Aluminum');
    }
}
