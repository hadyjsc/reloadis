<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class DropdownController extends Controller
{
    public function fetchType()
    {
        $model = Type::get(['id', 'name']);
        return $response()->json($model);
    }
}
