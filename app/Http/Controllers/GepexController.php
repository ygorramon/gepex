<?php

namespace App\Http\Controllers;

use App\Models\Gepex;
use App\Models\Gepex_Step;
use App\Models\Secretary;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Collection;

class GepexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    
       
        $secretaries = Auth::user()->secretaries()->paginate();
        return view('admin.gepexes.index', compact('secretaries'));
    }
    public function gepex_envidas_index()
    {
      
    
       
        $secretaries = Secretary::all();
        return view('admin.gepexes.gepex-enviadas-index', compact('secretaries'));
    }

    public function secretaria($id)
    {
        $secretary = Secretary::find($id);
        $gepexes =  $secretary->gepexes;

        return view('admin.gepexes.gepex-secretaria', compact('secretary', 'gepexes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $secretary = Secretary::find($id);
        $steps = Step::all();

        return view('admin.gepexes.create-edit', compact('secretary', 'steps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $secretary = Secretary::find($id);
        $data = $request->all();
        /*
       * Regras
       */
        //  dd($data);
        $this->rules = [
            'need' => 'required',
           

        ];
        /*
       * Mensagens
       */
        $messages = [
            'name.required' => 'O campo Necessidade é de preenchimento obrigatório',
            



        ];
        /*
       * Validação
       */

        $validate = validator($data, $this->rules, $messages);
        if ($validate->fails()) {
            return redirect()->route('gepex-secretaria-create')
                ->withErrors($validate)
                ->withInput();
        }

        $uid = IdGenerator::generate(['table' => 'gepexes', 'field' => 'uid', 'length' => 10, 'prefix' => $secretary->initials . '-']);

        $secretary->gepexes()->create([
            'uid' =>   $uid,
            'needs' => $data['need'],
          
            'priority' =>  $data['priority'],
            'completion_date' => $data['completion_date'],
            'price' => convertPrice($data['price']),
            'status' => 'LANÇADO'
        ]);

        return redirect()->route('gepex-secretaria', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gepex = Gepex::find($id);
        return view('admin.gepexes.show', compact('gepex'));
    }

    public function enviar_aprovacao($id)
    {
        $gepex = Gepex::find($id);
        $gepex->update(['status' => 'ENVIADO']);
        return redirect()->route('gepex-secretaria', $gepex->secretary->id);
    }

    public function iniciar_execucao($id)
    {
        $gepex = Gepex::find($id);
        $gepex->update(['status' => 'EM EXECUÇÃO']);
        return redirect()->route('gepex-secretaria', $gepex->secretary->id);
    }
    public function finalizar_execucao($id)
    {
        $gepex = Gepex::find($id);
        $gepex->update(['status' => 'FINALIZADO']);
        return redirect()->route('gepex-secretaria', $gepex->secretary->id);
    }


    public function analisar_gepex($id, Request $request)
    {

        $gepex = Gepex::find($id);

        $gepex->update([
            'status' =>            $request->status,
            'priority' => $request->priority,
            'obs' => $request->obs
        ]);
  return  redirect()->route('gepex-enviadas');    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ( !$gepex = Gepex::find($id)) {
            return redirect()->back();
        }
        
        $gepex->delete();

        return redirect()->route('gepex-secretaria', $gepex->secretary->id);

    }

    public function gepex_enviadas()
    {
        $gepexes = Gepex::whereIn('status', ['ENVIADO','APROVADO'])->get();
        return view('admin.gepexes.gepex-enviadas', compact('gepexes'));
    }

    public function gepex_execucao()
    {
        $gepexes = Gepex::whereIn('status', ['EM EXECUÇÃO'])->get();
        return view('admin.gepexes.gepex-execucao', compact('gepexes'));
    }

    public function gepex_todas()
    {
        $gepexes = Gepex::all();
        $secretaries = Secretary::all();
        return view('admin.gepexes.gepex-todas', compact('gepexes','secretaries'));
    }

    public function analise_gepex($id)
    {
        $gepex = Gepex::find($id);
        return view('admin.gepexes.analise-gepex', compact('gepex'));
    }

    public function defenir_etapas($id)
    {
        $gepex = Gepex::find($id);
        $steps_todos = Step::all();
        $steps_selecionados = $gepex->steps;

       
        
        return view('admin.gepexes.definir-etapas', compact('gepex', 'steps_todos', 'steps_selecionados'));
    }
    public function defenir_etapas_store($id, Request $request)
    {
        $gepex = Gepex::find($id);
        //  dd($request->step_id);
        if (isset($request->step_id)) {
            foreach ($request->step_id as $step_id) {

                //collect all inserted record IDs
                $photo_id_array[$step_id] = ['prevision_date' => $request->prevision_date[$step_id - 1]];
            }
        } else {
            $photo_id_array = null;
        }
        $gepex->steps()->sync($photo_id_array);
        
        return  redirect()->route('gepex-enviadas');
    }

    public function ver_etapas($id)
    {
        $gepex = Gepex::find($id);
        $steps = $gepex->steps;


        return view('admin.gepexes.ver-etapas', compact('gepex', 'steps'));
    }

    public function concluir_etapa($id, $etapaid, Request $request)
    {

        $gepex = Gepex::find($id);
        $steps = $gepex->steps;
        $gepex->steps()->updateExistingPivot($etapaid, [
            'finished' => $request->finished,
            'completion_date' => $request->completion_date,
            'obs' => $request->obs
        ]);


        return redirect()->route('gepex-ver-etapas', $gepex->id);
    }

    public function nova_data($id, $etapaid, Request $request)
    {
//dd($id);
        $gepex = Gepex::find($id);
        $steps = $gepex->steps;
        $gepex->steps()->updateExistingPivot($etapaid, [
            'prevision_date' => $request->prevision_date
        ]);


        return redirect()->route('relatorios.etapas');
    }

    public function enviar_para_aprovacao($id)
    {
        $gepex = Gepex::find($id);
        $gepex->update(['status' => 'ENVIADO']);
        $secretary = $gepex->secretary;
        return  redirect()->route('gepex-secretaria', $secretary->id);
    }

    public function search(Request $request)
    {

        $gepexes = Gepex
            ::where(function ($query) use ($request) {
                if ($request->uid) {
                    $query->orWhere('uid', 'LIKE', "%{$request->uid}%");
                }
            })
            ->where(function ($query) use ($request) {
                if ($request->status) {
                    $query->orWhere('status', $request->status);
                }
            })
            ->where(function ($query) use ($request) {
                if ($request->priority) {
                    $query->orWhere('priority', $request->priority);
                }
            })
            ->where(function ($query) use ($request) {
                if ($request->data_inicio && $request->data_fim) {
                $query->whereBetween('created_at', [$request->data_inicio, $request->data_fim]);
              //  $query->where('created_at', '>', now()->subDays($request->tempo));
                }
            })
            ->where('secretary_id',$request->secretary_id)
            
            ->latest()
            ->get();
        $secretary = Secretary::find($request->secretary_id);


        return view('admin.gepexes.gepex-secretaria', compact('secretary', 'gepexes','request'));
    }
    public function search_todas(Request $request)
    {

        $gepexes = Gepex
            ::where(function ($query) use ($request) {
                if ($request->uid) {
                    $query->Where('uid', 'LIKE', "%{$request->uid}%");
                }
            })
            ->where(function ($query) use ($request) {
                if ($request->status) {
                    $query->Where('status', $request->status);
                }
            })
            ->where(function ($query) use ($request) {
                if ($request->priority) {
                    $query->Where('priority', $request->priority);
                }
            })
            ->where(function ($query) use ($request) {
                if ($request->data_inicio && $request->data_fim) {
                    $query->whereBetween('created_at', [$request->data_inicio, $request->data_fim]);
                    //  $query->where('created_at', '>', now()->subDays($request->tempo));
                }
            })
            ->where(function ($query) use ($request) {
                if ($request->secretary_id) {
                $query->where('secretary_id', $request->secretary_id);
                }
            })
            
            ->latest()
            ->get();
        $secretaries = Secretary::all();


        return view('admin.gepexes.gepex-todas', compact('secretaries', 'gepexes','request'));
    }
}
