<?php

namespace Anodizado;

use Illuminate\Database\Eloquent\Model;

class InOutList extends Model
{
    protected $table = 'in_out_lists';

    protected $fillable = ['aluminum_id', 'colorI_id', 'colorO_id', 'quantity', 'client_id'];

    public $timestamps = false;

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

    public function ioPut()
    {
    	return $this->belongsTo('Anodizado\InOut');
    }

    public function client()
    {
        return $this->belongsTo('Anodizado\Client');
    }

    public function orders()
    {
        return $this->hasMany('Anodizado\ProductionList');
    }
}
