<?php

namespace App\Http\Controllers;

use App\Models\Gepex;
use App\Models\Secretary;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Haruncpi\LaravelIdGenerator\IdGenerator;
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
        return view ('admin.gepexes.index', compact('secretaries'));
    }

    public function secretaria($id){
        $secretary = Secretary::find($id);
        $gepexes =  $secretary->gepexes;
      
        return view ('admin.gepexes.gepex-secretaria', compact('secretary','gepexes'));
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

        return view('admin.gepexes.create-edit', compact('secretary','steps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $secretary=Secretary::find($id);
        $data = $request->all();
        /*
       * Regras
       */
    //  dd($data);
        $this->rules = [
            'need' => 'required',
            'goals' => 'required',
            'strategies' => 'required',

        ];
        /*
       * Mensagens
       */
        $messages = [
            'name.required' => 'O campo Necessidade é de preenchimento obrigatório',
            'goals.required' => 'O campo Objetivos é de preenchimento obrigatório',
            'strategies.required' => 'O campo Estratégias é de preenchimento obrigatório',




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

        $uid = IdGenerator::generate(['table' => 'gepexes','field'=>'uid', 'length' => 10, 'prefix' =>$secretary->initials.'-']);


        $secretary->gepexes()->
        create([
            'uid' =>   $uid,
            'needs' => $data['need'],
            'goals' => $data['goals'],
            'strategies' => $data['strategies'],
            'priority' =>  $data['priority'],
            'completion_date' => $data['completion_date'],
            'status' =>'INICIADO']);

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
        $gepex->update(['status'=>'ENVIADO PARA ANÁLISE']);
     return redirect()->route('gepex-secretaria', $gepex->secretary->id);
    }


    public function analisar_gepex($id, Request $request)
    {
        $gepex = Gepex::find($id);
        if($request->status=='S'){
            $request->status='APROVADO';
        }
        if ($request->status == 'N') {
            $request->status = 'REPROVADO';
        }
        $gepex->update(['status' =>            $request->status,
    'priority' =>$request->priority]);
        return redirect()->route('gepex-secretaria', $gepex->secretary->id);
    }
    
 
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
        //
    }

    public function gepex_enviadas(){
        $gepexes = Gepex::where('status','ENVIADO PARA ANÁLISE')->get();
        return view ('admin.gepexes.gepex-enviadas',compact('gepexes'));
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
        $steps_selecionados=$gepex->steps;
       // dd($steps_selecionados);
        return view('admin.gepexes.definir-etapas', compact('gepex','steps_todos', 'steps_selecionados'));
    }
    public function defenir_etapas_store($id, Request $request){
        $gepex = Gepex::find($id);
        $gepex->update(['status'=>'Em Construção']);
        $gepex->steps()->sync($request->step_id);

      return  redirect()->route('gepex.show', $gepex->id);
    }

    public function ver_etapas($id)
    {
        $gepex = Gepex::find($id);
        $steps = $gepex->steps;


        return view('admin.gepexes.ver-etapas', compact('gepex','steps'));
    }
    public function concluir_etapa($id,$etapaid)
    {
        $gepex = Gepex::find($id);
        $steps = $gepex->steps;
        $gepex->steps()->updateExistingPivot($etapaid, ['finished'=>1,'completion_date'=>now()]);


        return view('admin.gepexes.ver-etapa', compact('gepex','steps'));
    }

}
