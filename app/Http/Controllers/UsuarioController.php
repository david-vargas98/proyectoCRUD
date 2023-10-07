<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //Este método llama a la vista que se creó 
    public function profile()
    {
        return view('profile');
    }
}
