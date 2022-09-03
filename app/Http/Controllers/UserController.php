<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.create-edit');
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
            'email' => 'required|unique:users',
            'password' => 'required|min:6',

        ];
        /*
       * Mensagens
       */
        $messages = [
            'name.required' => 'O campo Nome é de preenchimento obrigatório',
            'name.min' => 'O campo Nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo Nome deve ter no máximo 200 caracteres',
            'email.required' => 'O campo Email é de preenchimento obrigatório',
            'email.unique' => 'Já existe um usuário com esse e-mail',
            'password.numeric' => 'O campo Senha é de preenchimento obrigatório',
            'password.min' => 'O campo Senha deve ter no mínimo 6 caracteres',




        ];
        /*
       * Validação
       */

        $validate = validator($data, $this->rules, $messages);
        if ($validate->fails()) {
            return redirect()->route('usuario.create')
                ->withErrors($validate)
                ->withInput();
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),

        ]);
        $users = User::all();
        return view('admin.usuarios.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $secretaries = $user->secretaries;



        return view('admin.usuarios.show', compact('user', 'secretaries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);


        return view('admin.usuarios.create-edit', compact('user'));
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
            'email' => 'required|unique:users,email,' . $id,


        ];
        /*
       * Mensagens
       */
        $messages = [
            'name.required' => 'O campo Nome é de preenchimento obrigatório',
            'name.min' => 'O campo Nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo Nome deve ter no máximo 200 caracteres',
            'email.required' => 'O campo Email é de preenchimento obrigatório',
            'email.unique' => 'Já existe um usuário com esse e-mail',





        ];
        /*
       * Validação
       */

        $validate = validator($dataForm, $this->rules, $messages);
        if ($validate->fails()) {
            return redirect()->route('usuario.edit', $id)
                ->withErrors($validate)
                ->withInput();
        }

        $user = User::find($id);
        $update = $user->update([
            'name' => $dataForm['name'],
            'email' => $dataForm['email']
        ]);
        if ($update)
            return redirect()->route('usuario.index');
        else
            return redirect()->route('usuario.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $delete = $user->delete();
        if ($delete)
            return redirect()->route('usuario.index');
        else
            return redirect()->route('usuario.show', $id)->with(['errors' => 'Falha ao deletar']);
    }
}
