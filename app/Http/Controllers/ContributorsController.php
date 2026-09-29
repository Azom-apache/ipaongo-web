<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContributorsController extends Controller
{
    public function index()
    {

        return view('contributors.contributors',compact('contributors'));
    }
}

