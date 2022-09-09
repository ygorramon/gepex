@extends('adminlte::page')


@section('content_header')
<div class="card">

        <div class="card-body">
<div class="box">
     <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item "><a href="{{route('usuario.index')}}">Usuários</a></li>
  <li class="breadcrumb-item active">Gestão de Usuários</li>
 
</ol>
  
    <div class="content">
    <h1 class="title-pg">Gestão de Usuários</h1>
@if(isset($errors)&& count($errors) >0)
<div class ="alert alert-danger">
    @foreach($errors->all() as $error )
    <p> {{$error}}</p>
    @endforeach
</div>
@endif

@if(isset($user))
<form class="form" method="post" action="{{route('usuario.update',$user->id)}}">
    {{ method_field('PUT')}}
    @else
    
<form id="form" class="form" method="post" action="{{route('usuario.store')}}">
    @endif
    {!! csrf_field() !!}
    <div class="row">
        
    <div class="form-group col-md-7">
        <label >Nome:</label><input type="text" autocomplete="off" name="name" required minlength="5" class="form-control" value="{{$user->name ?? ''}}">
    </div>
   
    </div>
     <div class="row">
    <div class="form-group col-md-3">
        <label >Email:</label>   <input  type="email" autocomplete="off" name="email" required class="form-control" value="{{$user->email ?? ''}}">
    </div>
     </div>
    @if(isset($user))
    @else
     <div class="row">
    <div class="form-group col-md-3">
        <label >Senha:</label>   <input autocomplete="off" type="password" name="password" required maxlength="14" class="form-control" value="{{$user->password ?? '' }}">
    </div>
    </div>
    @endif
    
    <div class="row">
   <div class="form-group  col-md-3">
    <button class="btn btn-success">  <span class="glyphicon glyphicon-ok"></span> Enviar</button>
    <a  class="btn btn-danger" href="{{route('usuario.index')}}">
         <span class="glyphicon glyphicon-remove"></span> Cancelar
            </a>
    </div>
    </div>
    
    
</form>
</div>
</div>
        </div>
</div>
@stop