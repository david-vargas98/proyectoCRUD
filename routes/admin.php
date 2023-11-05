<?php

use Illuminate\Support\Facades\Route;

route::get('', function () {
    return "hola admin";
})->middleware('auth');