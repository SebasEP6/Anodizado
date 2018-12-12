<?php

namespace Anodizado\Http\Controllers;

use Illuminate\Http\Request;

use Anodizado\Http\Requests;
use Anodizado\Http\Controllers\Controller;

class UsersController extends Controller
{
    function index()
    {
    	return view('prueba');
    }
}
