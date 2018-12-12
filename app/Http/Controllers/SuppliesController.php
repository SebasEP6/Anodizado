<?php

namespace Anodizado\Http\Controllers;

use Illuminate\Http\Request;

use Anodizado\Http\Requests;
use Anodizado\Http\Controllers\Controller;

use Anodizado\Material;
use Anodizado\Consume;
use Anodizado\ConsumeList;
use Anodizado\Index;
use Anodizado\Partial;
use Anodizado\PartialList;
use Anodizado\Matriz;

use Carbon\Carbon;

class SuppliesController extends Controller
{
    function index($process, $i = null)
    {
        $supplies = Material::lists('name', 'id');

        return view('views.indexes', compact('supplies', 'i'));
    }

    function viewIndex(Request $request, $process, $i)
    {
        $supplies = Material::lists('name', 'id');
        $indexes = Index::where('material_id', $request->supplies)
                        ->where('index', '>=', 0)
                        ->get();

        if ($indexes != null)
        {
            $data = [
                'name' => $indexes->last()->material->name,
                'attributes' => []
            ];

            foreach ($indexes as $index)
            {
                $attribute['year'] = \Carbon\Carbon::Parse($index->date_out)->format('Y');
                $attribute['month'] = \Carbon\Carbon::Parse($index->date_out)->format('m');
                $attribute['day'] = \Carbon\Carbon::Parse($index->date_out)->format('d');
                $attribute['index'] = $index->index;
                array_push($data['attributes'], $attribute);
            }

            return view('views.indexes', compact('supplies', 'i', 'data'));
        }

        return redirect()->back()->withErrors('El insumo que selecciono no ha generado ning&uacute;n indice a&uacute;n');
    }

    function view($process)
    {
        $lists = ConsumeList::paginate(15);

        return view('views.consume', compact('lists', 'process'));
    }

    function regSuppliesNote($process, $type, $i = null)
    {
    	$supplies = Material::get();

    	if($i != null)
    	{
    		$items = ConsumeList::where('consume_id', $i)->get();
    	}

    	return view('registers.supPuts', compact('supplies', 'items', 'type', 'i'));
    }

    function postRegSuppliesNote(Request $request, $process, $type, $i = null)
    {
        $supply = Material::findOrFail($request->item_id);

       	$item = new ConsumeList([
    		'material_id' => $supply->id,
    	]);

        if($process == 'anodizado')
        {
            $item->quantity = $request->aQuantity;
            if($type == 'input')
            {
                $supply->aQuantity = $supply->aQuantity + $item->quantity;
            }
            else
            {
                if($supply->aQuantity >= $item->quantity)
                {
                    $supply->aQuantity = $supply->aQuantity - $item->quantity;

                    $index = Index::where('material_id', $supply->id)
                                    ->where('date_out', null)->get();
                    $index = $index->last();
                    $date = Carbon::now();

                    if ($index != null)
                    {
                        $orders = Partial::where('created_at', '>=', $index->date_in)
                                    ->where('created_at', '<=', $date)
                                    ->get();

                        $result = 0;

                        foreach ($orders as $order)
                        {
                            $items = PartialList::where('partial_id', $order->id)->get();

                            foreach ($items as $orderItem)
                            {
                                $rule = Matriz::where('material_id', $supply->id)
                                            ->where('color_id', $orderItem->color_id)
                                            ->get();

                                $rule = $rule->last();

                                if ($rule->value == 1)
                                {
                                    $result = $result + ($orderItem->total * $orderItem->alItem->area);
                                }
                            }
                        }

                        $result = $result / $index->quantity;

                        $index->date_out = $date;
                        $index->index = $result;
                        $index->save();
                    }
                    $regIndex = new Index();
                    $regIndex->material_id = $supply->id;
                    $regIndex->date_in = $date;
                    $regIndex->process = $process;
                    $regIndex->quantity = $request->quantity;
                    $regIndex->save();
                }
                else
                {
                    return redirect()->back()->withErrors('La cantidad debe ser menor o igual a la existente');
                }
            }
        }
        else
        {
            $item->quantity = $request->pQuantity;
            if($type == 'input')
            {
                $supply->pQuantity = $supply->pQuantity + $item->quantity;
            }
            else
            {
                if($supply->pQuantity >= $item->quantity)
                {
                    $supply->pQuantity = $supply->pQuantity - $item->quantity;

                    $index = Index::where('material_id', $supply->id)
                                    ->where('date_out', null)->get();
                    $index = $index->last();
                    $date = Carbon::now();

                    if ($index != null)
                    {
                        $orders = Partial::where('created_at', '>=', $index->date_in)
                                    ->where('created_at', '<=', $date)
                                    ->get();

                        $result = 0;

                        foreach ($orders as $order)
                        {
                            $items = PartialList::where('partial_id', $order->id)->get();

                            foreach ($items as $orderItem)
                            {
                                $rule = Matriz::where('material_id', $supply->id)
                                            ->where('color_id', $orderItem->color_id)
                                            ->get();

                                $rule = $rule->last();

                                if ($rule->value == 1)
                                {
                                    $result = $result + ($orderItem->total * $orderItem->alItem->area);
                                }
                            }
                        }

                        $result = $result / $index->quantity;

                        $index->date_out = $date;
                        $index->index = $result;
                        $index->save();
                    }
                    $regIndex = new Index();
                    $regIndex->material_id = $supply->id;
                    $regIndex->date_in = $date;
                    $regIndex->process = $process;
                    $regIndex->quantity = $item->quantity;
                    $regIndex->save();
                }
                else
                {
                    return redirect()->back()->withErrors('La cantidad debe ser menor o igual a la existente');
                }
        }

    	$supply->save();

    	if($i != null)
    	{
    		$item->consume_id = $i;
    	}
    	else
    	{
    		$list = new Consume();
    		$list->process = $process;
    		$list->type = $type;
    		$list->save();

    		$item->consume_id = $list->id;

    		$i = $list->id;
    	}

        $item->save();

    	return redirect()->route('regSup', [$process, $type, $i]);
    }
}
}