<?php

namespace Anodizado\Http\Controllers;

use Illuminate\Http\Request;

use Anodizado\Http\Requests;
use Anodizado\Http\Controllers\Controller;

use Anodizado\Client;

class ClientsController extends Controller
{
    function add(Request $request)
    {
        $client = new Client([
            'name' => $request->name
        ]);
        $client->save();

        return redirect()->back();
    }
}
