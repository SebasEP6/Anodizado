<?php

namespace Anodizado\Http\Controllers;

use Illuminate\Http\Request;

use Anodizado\Http\Requests;
use Anodizado\Http\Controllers\Controller;

use Anodizado\Aluminum;
use Anodizado\Material;
use Anodizado\Color;
use Anodizado\Matriz;

class AdminController extends Controller
{
    function process($type)
    {
    	session(['process' => $type]);
    	return redirect()->route('mp', session('process'));
    }

    function addAlItem(Request $request)
    {
    	$item = new Aluminum([
    		'quantity' => 0,
    		'aGroup'   => $request->aGroup,
    		'pGroup'   => $request->pGroup
    	]);

        $item->code = $request->code;
     	$item->name = $request->name;
    	$item->group = $request->group;
    	$item->area = $request->area;
    	$item->weight = $request->weight;

    	$item->save();

    	return redirect()->back();
    }

    function addSupply(Request $request)
    {
        $supply = new Material();

        $supply->code = $request->code;
        $supply->name = $request->name;
        $supply->aQuantity = 0;
        $supply->pQuantity = 0;

        $supply->save();

        return redirect()->route('nr', $supply->id);
    }

    function addRule($i)
    {
        $colors = Color::where('name', '<>', 'NT')->get();

        return view('admin.add-rule', compact('i', 'colors'));
    }

    function postAddRule(Request $request, $i)
    {
        $colors = Color::where('name', '<>', 'NT')->get();

        foreach ($colors as $color)
        {
            $rule = new Matriz();
            $rule->material_id = $i;
            $rule->color_id = $color->id;
            $rule->value = $request[$color->name];
            $rule->save();
        }

        return redirect()->route('rules');
    }

    function addColorRule($i)
    {
        $supplies = Material::get();

        return view('admin.add-color-rule', compact('supplies', 'i'));
    }

    function postAddColorRule(Request $request, $i)
    {
        $supplies = Material::get();

        foreach ($supplies as $supply)
        {
            $rule = new Matriz();
            $rule->material_id = $supply->id;
            $rule->color_id = $i;
            $rule->value = $request[$supply->id];
            $rule->save();
        }

        return redirect()->route('rules');
    }

    function rules()
    {
        $material = Material::get();
        $colors = Color::where('code', '<>', 'NT')->get();
        $rules = array();

        foreach ($material as $supply)
        {
            $items = Matriz::where('material_id', $supply->id)->get();
            $rule = ['id' => $supply->id, 'material' => $supply->name];

            foreach ($items as $item)
            {
                $rule[$item->color_id] = $item->value;
            }

            array_push($rules, $rule);
        }

        return view('admin.rules', compact('rules', 'colors'));
    }

    function edRules($i)
    {
        $rules = Matriz::where('material_id', $i)->get();

        return view('admin.edit-rules', compact('rules'));
    }

    function postEdRules(Request $request, $i)
    {
        $rule = Matriz::findOrFail($request->id);
        $rule->value = $request->value;
        $rule->save();

        return redirect()->back();
    }

    function makeRepo($process)
    {
        return view('registers.reports', compact('process'));
    }

    function postMakeRepo(Request $request, $process)
    {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('views.report', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }

    public function getData()
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }

}
