<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthApiController extends Controller
{
    public function local()
    {
        return response()->json(auth()->user());
    }

    public function oauth()
    {
        return response()->json(auth()->user());
    }

}
