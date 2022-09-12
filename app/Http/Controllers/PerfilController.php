<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //cho $json1->name;
        $perfis = Perfil::all();

        return view("admin.perfils.index", compact("perfis"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.perfils.create-edit');
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
            'name' => 'required|max:200|min:3|unique:perfils',
        

        ];
        /*
       * Mensagens
       */
        $messages = [
            'name.unique' => 'Já existe uma secretaria com esse nome',
            'name.required' => 'O campo name é de preenchimento obrigatório',
           
            'name.min' => 'O campo name deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo name deve ter no máximo 200 caracteres',





        ];
        /*
       * Validação
       */

        $validate = validator($data, $this->rules, $messages);
        if ($validate->fails()) {
            return redirect()->route('perfil.create')
                ->withErrors($validate)
                ->withInput();
        }

        Perfil::create([
            'name' => $data['name'],
            


        ]);
        $perfis = Perfil::all();
        return view('admin.perfils.index', compact("perfis"));
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
        $perfil = Perfil::find($id);


        return view('admin.perfils.create-edit', compact('perfil'));
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
            'name.unique' => 'Já existe uma secretaria com esse nome',
            'name.required' => 'O campo name é de preenchimento obrigatório',
            
            'name.min' => 'O campo name deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo name deve ter no máximo 200 caracteres',





        ];
        /*
       * Validação
       */

        $validate = validator($dataForm, $this->rules, $messages);
        if ($validate->fails()) {
            return redirect()->route('perfil.edit', $id)
                ->withErrors($validate)
                ->withInput();
        }

        $Perfil = Perfil::find($id);
        $update = $Perfil->update([
            'name' => $dataForm['name']
        ]);
        if ($update)
            return redirect()->route('perfil.index');
        else
            return redirect()->route('perfil.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfil = Perfil::find($id);

        $delete = $perfil->delete();
        if ($delete)
            return redirect()->route('perfil.index');
        else
            return redirect()->route('perfil.index')->with(['errors' => 'Falha ao deletar']);
    }
    public function servidores($id)
    {

        $perfil = Perfil::find($id);
        $users = $perfil->servidores;

        return view('admin.perfils.servidores', compact('perfil', 'users'));
    }
    public function adicionarServidores($id)
    {
        $servidores_todos = \App\User::all();
        $perfil = Perfil::find($id);
        $servidores = $perfil->servidores;
        return view('admin.perfils.editar', compact('perfil', 'servidores', 'servidores_todos'));
    }

    public function storeServidores(Request $request)
    {
        $perfil = Perfil::find($request->perfil_id);

        //$company->cities()->attach($dataForm);
        $insert = $perfil->servidores()->sync($request->user_id);
        //$company->cities()->detach(1); 
        if ($insert) {

            $users = $perfil->servidores;
            return view('admin.perfils.servidores', compact('users', 'perfil'));
        } else
            return redirect()->back();
    }
}