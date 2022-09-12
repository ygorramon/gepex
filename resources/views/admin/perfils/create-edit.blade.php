@extends('adminlte::page')

@section('title', 'GEPEX')

@section('content_header')
<div class="card">

        <div class="card-body">
<div class="box">
<div class="box">
     <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item "><a href="{{route('perfil.index')}}">Perfis</a></li>
  <li class="breadcrumb-item active">Gestão de Perfis</li>
 
</ol>
  
    <div class="content">
    <h1 class="title-pg">Gestão de Perfis</h1>
@if(isset($errors)&& count($errors) >0)
<div class ="alert alert-danger">
    @foreach($errors->all() as $error )
    <p> {{$error}}</p>
    @endforeach
</div>
@endif

@if(isset($perfil))
<form class="form" method="post" action="{{route('perfil.update',$perfil->id)}}">
    {{ method_field('PUT')}}
    @else
    
<form id="form" class="form" method="post" action="{{route('perfil.store')}}">
    @endif
    {!! csrf_field() !!}
    <div class="row">
        
    <div class="form-group col-md-7">
        <label >Nome:</label><input type="text" autocomplete="off" name="name" required class="form-control" value="{{$perfil->name ?? ''}}">
    </div>
   
    </div>
    <div class="row">
        
    </div>
    
    
    <div class="row">
   <div class="form-group  col-md-3">
    <button class="btn btn-success"> <span class="glyphicon glyphicon-ok"></span> Enviar</button>
    <a  class="btn btn-danger" href="{{route('perfil.index')}}">
         <span class="glyphicon glyphicon-remove"></span>Cancelar
            </a>
    </div>
    </div>
    
    
</form>
</div>
</div>
</div>
        </div>
@stop