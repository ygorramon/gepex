<?php

namespace App\Http\Controllers;

use App\Models\Secretary;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $secretaries = Secretary::all();
        return view ('admin.relatorios.index', compact ('secretaries'));
    }
}
