<?php

namespace Anodizado\Http\Controllers;

use Illuminate\Http\Request;

use Anodizado\Http\Requests;
use Anodizado\Http\Controllers\Controller;

use Anodizado\Material;
use Anodizado\Aluminum;
use Anodizado\Group;
use Anodizado\Color;

class StorageController extends Controller
{
    function matView($process)
    {
        $materials = Material::paginate(10);

        return view('views.materials', compact('materials', 'process'));
    }

    function alumView($process)
    {
    	$aluminum = Aluminum::paginate(15);

    	return view('views.aluminum', compact('aluminum'));
    }

    function editSupply($process)
    {
        $supplies = Material::paginate();

        return view('admin.supplies', compact('supplies'));
    }

    function postEditSupply(Request $request, $process)
    {
        $supply = Material::findOrFail($request->id);

        $supply->code = $request->code;
        $supply->aQuantity = $request->aQuantity;
        $supply->pQuantity = $request->pQuantity;

        $supply->save();

        return redirect()->route('edSup', $process);
    }

    function editAlum($process)
    {
        $aluminum = Aluminum::paginate(15);
        $groups = Group::lists('name', 'id');

        return view('admin.aluminum', compact('aluminum', 'groups'));
    }

    function postEditAlum(Request $request, $process)
    {
        $piece = Aluminum::findOrFail($request->id);
        $piece->code = $request->code;
        $piece->name = $request->name;
        $piece->group_id = $request->group_id;
        $piece->area = $request->area;
        $piece->weight = $request->weight;
        $piece->pGroup = $request->pGroup;
        $piece->aGroup = $request->aGroup;
        $piece->save();

        return redirect()->back();
    }

    function edGroup($process)
    {
        $groups = Group::paginate(10);

        return view('admin.groups', compact('groups'));
    }

    function postEditGroup(Request $request, $process, $i)
    {
        $group = Group::findOrFail($i);
        $group->code = $request->code;
        $group->name = $request->name;
        $group->save();

        return redirect()->back();
    }

    function newGroup(Request $request)
    {
        $group = new Group();
        $group->code = $request->code;
        $group->name = $request->name;
        $group->save();

        return redirect()->back();
    }

    function editColor($process)
    {
        $colors = Color::get();

        return view('admin.colors', compact('colors'));
    }

    function postEditColor(Request $request, $process, $i)
    {
        $color = Color::findOrFail($i);
        $color->code = $request->code;
        $color->name = $request->name;
        $color->save();

        return redirect()->back();
    }

    function newColor(Request $request)
    {
        $color = new Color();
        $color->code = $request->code;
        $color->name = $request->name;
        $color->save();

        return redirect()->route('newCRule', $color->id);
    }

    function mkTransfer($process)
    {
        $supplies = Material::get();

        return view('registers.transfer', compact('supplies'));
    }

    function postMkTransfer(Request $request, $process)
    {
        $supply = Material::findOrFail($request->id);
        if($request->transfer == 'pintura')
        {
            if ($supply->aQuantity >= $request->quantity)
            {
                $supply->aQuantity = $supply->aQuantity - $request->quantity;
                $supply->pQuantity = $supply->pQuantity + $request->quantity;
            }
            else
            {
                return redirect()->back()->withErrors('La cantidad deseada supera la existente');
            }
        }
        else
        {
            if ($supply->pQuantity >= $request->quantity)
            {
                $supply->pQuantity = $supply->pQuantity - $request->quantity;
                $supply->aQuantity = $supply->aQuantity + $request->quantity;
            }
            else
            {
                return redirect()->back()->withErrors('La cantidad deseada supera la existente');
            }
        }
        $supply->save();

        return redirect()->back();
    }
}
