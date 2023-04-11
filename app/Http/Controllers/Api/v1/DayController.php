<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\DayModal;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function index()
    {
        return response()->json(DayModal::all(), 200);
    }
}
