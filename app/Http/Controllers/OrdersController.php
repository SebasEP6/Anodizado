<?php

namespace Anodizado\Http\Controllers;

use Illuminate\Http\Request;

use Anodizado\Http\Requests;
use Anodizado\Http\Controllers\Controller;

use Anodizado\Production;
use Anodizado\ProductionList;
use Anodizado\Partial;
use Anodizado\PartialList;
use Anodizado\Color;
use Anodizado\Aluminum;
use Anodizado\InOut;
use Anodizado\InOutList;

class OrdersController extends Controller
{
    function prodView($process)
    {
    	$orders = Production::where('process', $process)
                                ->orWhere('process')
                                ->orderBy('id', 'DESC')
                                ->paginate(20);

    	return view('views.production', compact('orders'));
    }

    function partView($process)
    {
    	$orders = Partial::where('process', $process)
                            ->orWhere('process')
                            ->orderBy('id', 'DESC')
                            ->paginate(20);

    	return view('views.partials', compact('orders'));
    }

    function prodRegister($process, $i = null)
    {
    	$moves = InOut::where('process', $process)
                        ->where('type', 'input')
                        ->get();

        if($i != null)
        {
            $items = ProductionList::where('production_id', $i)->get();
        }

    	return view('registers.production', compact('moves', 'items', 'i', 'process'));
    }

    function postProdRegister(Request $request, $process, $i = null)
    {
        $item = InOutList::findOrFail($request->item_id);

        if($item->quantity >= $request->quantity)
        {
            $item->quantity = $item->quantity - $request->quantity;
            $item->save();

            $list = new ProductionList([
                'in_out_lists_id' => $request->item_id,
                'quantity'        => $request->quantity,
                'group'           => $request->group
            ]);

            $list->total = $request->quantity;
            $list->aluminum_id = $item->aluminum_id;
            $list->colorI_id = $item->colorI_id;
            $list->colorO_id = $item->colorO_id;
            $list->client_id = $item->client_id;
        }
        else
        {
            return redirect()->back()->withErrors('La cantidad debe ser menor o igual a la existente');
        }

        if ($i != null)
        {
            $list->production_id = $i;
        }
        else
        {
            $order = new Production();
            $order->process = $process;
            $order->save();

            $list->production_id = $order->id;
            $i = $order->id;
        }

        $list->save();

        return redirect()->route('ro', [$process, $i]);
    }

    function partRegister($process, $i = null)
    {
        $orders = Production::where('process', $process)
                                ->get();

        if($i != null)
        {
            $items = PartialList::where('partial_id', $i)->get();
        }

        return view('registers.partial', compact('orders', 'items', 'i', 'process'));
    }

    function postPartRegister(Request $request, $process, $i = null)
    {
        $item = ProductionList::findOrFail($request->item_id);

        if($item->quantity >= $request->quantity)
        {
            $item->quantity = $item->quantity - $request->quantity;
            $item->save();

            $list = new PartialList([
                'production_list_id' => $request->item_id,
                'quantity'        => $request->quantity
            ]);

            $list->total = $request->quantity;
            $list->aluminum_id = $item->aluminum_id;
            $list->color_id = $item->colorO_id;
            $list->client_id = $item->client_id;
        }
        else
        {
            return redirect()->back()->withErrors('La cantidad debe ser menor o igual a la existente');
        }

        if ($i != null)
        {
            $list->partial_id = $i;
        }
        else
        {
            $order = new Partial();
            $order->process = $process;
            $order->save();

            $list->partial_id = $order->id;
            $i = $order->id;
        }

        $list->save();

        return redirect()->route('regPart', [$process, $i]);
    }
}
