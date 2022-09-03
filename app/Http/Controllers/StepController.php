<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $steps = Step::all();
        return view('admin.etapas.index', compact('steps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.etapas.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        /*
       * Regras
       */
        $this->rules = [
            'name' => 'required|max:200|min:3',
           

        ];
        /*
       * Mensagens
       */
        $messages = [
            'name.required' => 'O campo Nome é de preenchimento obrigatório',
            'name.min' => 'O campo Nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo Nome deve ter no máximo 200 caracteres',
            



        ];
        /*
       * Validação
       */

        $validate = validator($data, $this->rules, $messages);
        if ($validate->fails()) {
            return redirect()->route('etapa.create')
            ->withErrors($validate)
                ->withInput();
        }

        Step::create([
            'name' => $data['name'],
          

        ]);

        return redirect()->route('etapa.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $step = Step::find($id);
      



        return view('admin.etapas.show', compact('step'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $step = Step::find($id);


        return view('admin.etapas.create-edit', compact('step'));
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
        $dataForm = $request->all();
        /*
       * Regras
       */
        $this->rules = [
            'name' => 'required|max:200|min:3',
            


        ];
        /*
       * Mensagens
       */
        $messages = [
            'name.required' => 'O campo Nome é de preenchimento obrigatório',
            'name.min' => 'O campo Nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo Nome deve ter no máximo 200 caracteres',
           





        ];
        /*
       * Validação
       */

        $validate = validator($dataForm, $this->rules, $messages);
        if ($validate->fails()) {
            return redirect()->route('etapa.edit', $id)
            ->withErrors($validate)
                ->withInput();
        }

        $step = Step::find($id);
        $update = $step->update([
            'name' => $dataForm['name'],
          
        ]);
        if ($update)
            return redirect()->route('etapa.index');
        else
            return redirect()->route('etapa.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $step = Step::find($id);
        $delete = $step->delete();
        if ($delete)
            return redirect()->route('etapa.index');
        else
            return redirect()->route('etapa.show', $id)->with(['errors' => 'Falha ao deletar']);
    }
}
