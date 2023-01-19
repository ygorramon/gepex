<?php

namespace App\Http\Controllers;

use App\Models\Gepex_Step;
use App\Models\Secretary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    public function index(){
       
        $secretaries = Secretary::all();
        return view ('admin.relatorios.index', compact ('secretaries'));
    }

    public function etapas(){
        $gepex_steps=Gepex_Step::all();
        $secretaries=Secretary::all();
     return view ('admin.relatorios.etapas', compact('gepex_steps','secretaries'));
    }

    public function search_todas(Request $request)
    {
        if($request->acao=="filtro"){
        $gepex_steps = Gepex_Step::
        join('gepexes','gepexes.id','=','gepex_step.gepex_id')->
        join('steps','steps.id','=','gepex_step.step_id')->
        join('secretaries','secretaries.id','=','gepexes.secretary_id')->
        where(function ($query) use ($request) {
            if ($request->uid) {
                $query->orWhere('uid', 'LIKE', "%{$request->uid}%");
            }
        })->
        where(function ($query) use ($request) {
                if ($request->priority) {
                    $query->orWhere('priority', $request->priority);
                }
            })->
             
        where(function ($query) use ($request) {
                if (is_numeric($request->finished)) {
                    $query->where('finished', $request->finished);
                }
            })->
          
        where(function ($query) use ($request) {
                if ($request->secretary_id) {
                    $query->where('gepexes.secretary_id', $request->secretary_id);
               }
            })->
           
        get();

        $secretaries = Secretary::all();
        return view('admin.relatorios.etapas', compact('gepex_steps', 'secretaries','request'));
        }
        if ($request->acao == "pdf") {
            $gepex_steps = Gepex_Step::join('gepexes', 'gepexes.id', '=', 'gepex_step.gepex_id')->join('steps', 'steps.id', '=', 'gepex_step.step_id')->join('secretaries', 'secretaries.id', '=', 'gepexes.secretary_id')->where(function ($query) use ($request) {
                if ($request->uid) {
                    $query->orWhere('uid', 'LIKE', "%{$request->uid}%");
                }
            })->where(function ($query) use ($request) {
                    if ($request->priority) {
                        $query->orWhere('priority', $request->priority);
                    }
                })->where(function ($query) use ($request) {
                    if (is_numeric($request->finished)) {
                        $query->where('finished', $request->finished);
                    }
                })->where(function ($query) use ($request) {
                    if ($request->secretary_id) {
                        $query->where('gepexes.secretary_id', $request->secretary_id);
                    }
                })->get();

            $secretaries = Secretary::all();
          //  return view('admin.relatorios.report', compact('gepex_steps', 'secretaries', 'request'));

            PDF::loadView('admin.relatorios.report', compact('gepex_steps', 'secretaries', 'request'))->stream();
        }
    }

    public function relatorio(){
      
        $secretaries = Secretary::all();
        //return view ('admin.relatorios.report', compact('secretaries'));
        //   return \PDF::loadView('admin.relatorios.report', compact('secretaries'))
        // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
        //        ->stream();

        PDF::loadView('admin.relatorios.report')->stream();
    
    }
}
