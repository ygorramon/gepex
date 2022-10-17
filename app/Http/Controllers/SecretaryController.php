<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secretary;

class SecretaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //cho $json1->name;
        $secretaries = Secretary::all();

        return view("admin.secretarias.index", compact("secretaries"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.secretarias.create-edit');
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
            'name' => 'required|max:200|min:3|unique:secretaries',
            'initials' =>'required|max:200|min:3|unique:secretaries',

        ];
        /*
       * Mensagens
       */
        $messages = [
            'name.unique' => 'Já existe uma secretaria com esse nome',
            'name.required' => 'O campo name é de preenchimento obrigatório',
            'initials.unique' => 'Já existe uma Sigla como essa',
            'initials.required' => 'O campo SIGLA é de preenchimento obrigatório',
            'name.min' => 'O campo name deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo name deve ter no máximo 200 caracteres',





        ];
        /*
       * Validação
       */

        $validate = validator($data, $this->rules, $messages);
        if ($validate->fails()) {
            return redirect()->route('secretaria.create')
                ->withErrors($validate)
                ->withInput();
        }

        Secretary::create([
            'name' => $data['name'],
            'initials' => $data['initials'],


        ]);
        $secretaries = Secretary::all();
        return view('admin.secretarias.index', compact("secretaries"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $secretary = Secretary::find($id);


        return view('admin.secretarias.create-edit', compact('secretary'));
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
            'initials' => 'required|max:200|min:3',



        ];
        /*
       * Mensagens
       */
        $messages = [
            'name.unique' => 'Já existe uma secretaria com esse nome',
            'name.required' => 'O campo name é de preenchimento obrigatório',
            'initials.unique' => 'Já existe uma Sigla como essa',
            'initials.required' => 'O campo SIGLA é de preenchimento obrigatório',
            'name.min' => 'O campo name deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo name deve ter no máximo 200 caracteres',





        ];
        /*
       * Validação
       */

        $validate = validator($dataForm, $this->rules, $messages);
        if ($validate->fails()) {
            return redirect()->route('secretaria.edit', $id)
                ->withErrors($validate)
                ->withInput();
        }

        $secretary = Secretary::find($id);
        $update = $secretary->update([
            'name' => $dataForm['name']
        ]);
        if ($update)
            return redirect()->route('secretaria.index');
        else
            return redirect()->route('secretaria.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $secretary = Secretary::find($id);

        $delete = $secretary->delete();
        if ($delete)
            return redirect()->route('secretaria.index');
        else
            return redirect()->route('secretaria.index')->with(['errors' => 'Falha ao deletar']);
    }
    public function servidores($id)
    {

        $secretary = Secretary::find($id);
        $users = $secretary->servidores;

        return view('admin.secretarias.servidores', compact('secretary', 'users'));
    }
    public function adicionarServidores($id)
    {
        $servidores_todos = \App\User::all();
        $secretary = Secretary::find($id);
        $servidores = $secretary->servidores;
        return view('admin.secretarias.editar', compact('secretary', 'servidores', 'servidores_todos'));
    }

    public function storeServidores(Request $request)
    {
        $secretary = Secretary::find($request->secretary_id);

        //$company->cities()->attach($dataForm);
        $insert = $secretary->servidores()->sync($request->user_id);
        //$company->cities()->detach(1); 
        if ($insert) {

            $users = $secretary->servidores;
            return view('admin.secretarias.servidores', compact('users', 'secretary'));
        } else
            return redirect()->back();
    }
}
