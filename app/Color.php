<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    protected $fillable = ['name'];

    public $timestamps = false;

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
}
