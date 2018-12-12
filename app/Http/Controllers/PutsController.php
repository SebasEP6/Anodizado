<?php

namespace Anodizado\Http\Controllers;

use Illuminate\Http\Request;

use Anodizado\Http\Requests;
use Anodizado\Http\Controllers\Controller;

use Anodizado\InOut;
use Anodizado\InOutList;
use Anodizado\Color;
use Anodizado\Aluminum;
use Anodizado\Client;
use Anodizado\Partial;
use Anodizado\PartialList;

class PutsController extends Controller
{
   function view($process, $type)
    {
        $moves = InOut::where('type', $type)
                        ->where('process', $process)
                        ->orderBy('id', 'DESC')->paginate(20);

        return view('views.puts', compact('type', 'moves'));
    }

    function register($process, $type, $i = null)
    {
        if($i != null)
        {
            $items = InOutList::where('in_out_id', $i)->get();
        }

        if($type == 'input')
        {
            $colors = Color::lists('name', 'id');
            $aluminum = Aluminum::orderBy('code', 'ASC')->get();
            $clients = Client::get();

            return view('registers.inputs', compact('colors', 'type', 'aluminum', 'clients', 'items', 'i'));
        }

        $lists = Partial::get();

        return view('registers.outputs', compact('items', 'lists', 'type', 'i'));
    }

    function postRegister(Request $request, $process, $type, $i = null)
    {
        if($type == 'input')
        {
            $item = new InOutList([
                'aluminum_id'   => $request->aluminum,
                'colorI_id'     => $request->colorI,
                'colorO_id'     => $request->colorO,
                'quantity'      => $request->quantity,
                'client_id'     => $request->client
            ]);

            if ($i != null)
            {
                $item->in_out_id = $i;
            }
            else
            {
                $prod = new InOut([
                    'type' => $type
                ]);
                $prod->process = $process;
                $prod->save();

                $item->in_out_id = $prod->id;
                $i = $prod->id;
            }

            $item->total = $request->quantity;
            $item->save();

            return redirect()->route('regPut', [$process, $type, $i]);
        }

        $partItem = PartialList::findOrFail($request->item_id);

        $item = new InOutList([
            'aluminum_id'   => $request->item_id,
            'colorO_id'     => $partItem->color_id,
            'quantity'      => $request->quantity,
            'client_id'     => $partItem->client_id
        ]);

        if($partItem->quantity >= $item->quantity)
        {
            $partItem->quantity = $partItem->quantity - $item->quantity;
            $partItem->save();
        }
        else
        {
            return redirect()->back()->withErrors('La cantidad debe ser menor o igual a la existente');
        }

        if($i != null)
        {
            $item->in_out_id = $i;
        }
        else
        {
            $list = new InOut([
                'type' => $type
            ]);
            $list->process = $process;
            $list->save();

            $item->in_out_id = $list->id;

            $i = $list->id;
        }

        $item->total = $request->quantity;
        $item->save();

        return redirect()->route('regPut', [$process, $type, $i]);
    }
}