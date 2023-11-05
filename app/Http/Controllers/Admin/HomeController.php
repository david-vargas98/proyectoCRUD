<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Se genera el método index
    public function index()
    {
        return view('admin.index');
    }
}
