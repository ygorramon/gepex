@extends('adminlte::page')


@section('content_header')
<div class="card">

        <div class="card-body">
<div class="box">

    <ol class="breadcrumb">
   <li class="breadcrumb-item"><a href="/home">Home</a></li>
  <li class="breadcrumb-item "><a href="/usuario">Usuários</a></li>
  <li class="breadcrumb-item active">Vizualizar Usuário</li>
 
</ol>
    <div class="container">
<div class="row">
        
    <div class="form-group col-md-7">
        <label >Nome:</label><input type="text" disabled="true" name="nome"  class="form-control" value="{{$user->name }}">
    </div>
   
    </div>
    
    <div class="row">
    <div class="form-group col-md-3">
      <label >Email:</label>   <input type="text"  disabled="true" name="email" class="form-control" value="{{$user->email }}">
    </div>
    <div class="form-group col-md-3">
      <label >CPF:</label>   <input type="text"  disabled="true" name="cpf" class="form-control" value="{{$user->cpf }}">
    </div>
    </div>
        <div class="row">
            <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                    <tr role="row">
                        <th width="40%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Setor</th>
                                            </tr>
                </thead>
                <tbody>
                    @forelse($user->secretaries as $secretary)
                    <tr role="row" class="odd">
                        <td>{{$secretary->name}} </td>
                                            </tr>
                    @empty
                    <tr><td colspan="3">Nenhuma Secretaria</td></tr>
                    @endforelse
                </tbody>

            </table>
        </div>
        </div>
    <div class="row">
    
          <hr>
<form class="form" method="post" action="{{route('usuario.destroy',$user->id)}}" onsubmit = "return confirm('Confirmar apagar?')">
    {{ method_field('DELETE')}}
    {!! csrf_field() !!}
     
     <a  href="{{route('usuario.edit',$user->id)}}"
                class="btn  btn-success">
         <span class="glyphicon glyphicon-pencil"></span>&ensp;Editar

            </a>
    <button class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>&ensp;Deletar</button>
     <a  class="btn btn-warning" href="{{route('usuario.index')}}">
         <span class="glyphicon glyphicon-remove"></span>&ensp;Cancelar
            </a>
</form>
          <br>
</div>
</div>
</div>
        </div>
@stop
