@extends('adminlte::page')

@section('title', 'Gerência TI')

@section('content_header')
<div class="card">

        <div class="card-body">
<div class="box">
    <ol class="breadcrumb">
   <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
<li class="breadcrumb-item "><a href="{{route('secretaria.index')}}">Secretaria</a></li>
  <li class="breadcrumb-item "><a href="{{url("/secretaria/$secretary->id/servidores")}}">Servidores da Secretaria</a></li>
  <li class="breadcrumb-item active">Gestão de Servidores da Secretaria</li>
 
</ol>
    <div class="content">
    <h1> {{$secretary->nome}}</h1>
<form class="form" method="post" action="{{url("admin/secretaria/$secretary->id/editar-servidores")}}" >
 <input type="hidden" name="secretary_id" value="{{$secretary->id}}">  
       {!! csrf_field() !!}

    <div class="row">
        <div class="col-sm-12 ">
            <div class="form-group">
                @forelse ($servidores_todos as $servidor)
                @if(isset($servidor->aluno))
                @else
                <input  type="checkbox" name="user_id[]"
                       @forelse ($servidores as $servidoresSelecionados)
                       @if($servidor->id==$servidoresSelecionados->id)
                       checked="true" 
                       @endif
                       @empty
                       @endforelse
                       value="{{$servidor->id}}" >
                       {{$servidor->name}}
                       <br>
                @endif
                @empty
                @endforelse

            </div>       
        </div>
    </div>
       <div class="form-group">
    <button class="btn btn-primary">Enviar</button>
    </div>
</form>
</div>
</div>
        </div>
</div>




@stop

