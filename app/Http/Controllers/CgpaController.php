<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CgpaController extends Controller
{
    public function create()
    {
        return view('cgpa.create');
    }
}