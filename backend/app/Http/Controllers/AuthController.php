<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Essa\APIToolKit\Api\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function hello()
    {
        return $this->responseSuccess('Mensaje exitoso', 'Hello');
    }
}
