<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SurveySubmission;

class FormHandlerController extends Controller
{
    public function index()
    {
        $submissions = SurveySubmission::all();
        return view('sys.form-handler.index', compact('submissions'));
    }

    public function updateSystem(Request $request)
    {
        dd(2);
    }
}
