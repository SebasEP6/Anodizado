<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class PartialList extends Model
{
    protected $table = 'partial_lists';

    protected $fillable = ['quantity', 'group', 'production_list_id'];

    public $timestamps = false;

    public function partial()
    {
    	return $this->belongsTo('Anodizado\Partial');
    }

    public function production()
    {
        return $this->belongsTo('Anodizado\ProductionList');
    }

    public function alItem()
    {
        return $this->belongsTo('Anodizado\Aluminum', 'aluminum_id');
    }

    public function color()
    {
        return $this->belongsTo('Anodizado\Color');
    }

    public function client()
    {
        return $this->belongsTo('Anodizado\Client');
    }
}
