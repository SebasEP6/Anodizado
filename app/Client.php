<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = ['name'];

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
