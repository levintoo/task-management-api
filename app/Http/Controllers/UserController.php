<?php

namespace App\Http\Controllers;

use App\Http\Resources\Admin\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new UserResource($request->user());
    }
}
