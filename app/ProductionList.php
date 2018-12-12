<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class ProductionList extends Model
{
    protected $table = 'production_lists';

    protected $fillable = ['quantity', 'in_out_lists_id', 'group'];

    public $timestamps = false;

    public function production()
    {
    	return $this->belongsTo('Anodizado\Production');
    }

    public function puts()
    {
        return $this->belongsToMany('Anodizado\InOutList');
    }

    public function partItems()
    {
        return $this->hasMany('Anodizado\PartialList');
    }

    public function alItem()
    {
        return $this->belongsTo('Anodizado\Aluminum', 'aluminum_id');
    }

    public function colorI()
    {
        return $this->belongsTo('Anodizado\Color', 'colorI_id');
    }

    public function colorO()
    {
        return $this->belongsTo('Anodizado\Color', 'colorO_id');
    }

    public function client()
    {
        return $this->belongsTo('Anodizado\Client');
    }
}
