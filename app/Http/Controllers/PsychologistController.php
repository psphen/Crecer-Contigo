<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PsychologistController extends Controller
{
    public function index()
    {
        return view('psychologist.index');
    }
}
