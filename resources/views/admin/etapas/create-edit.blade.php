@extends('adminlte::page')

@section('title', 'Licita IF')

@section('content_header')
<div class="card">

        <div class="card-body">
<div class="box">
     <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item "><a href="{{route('etapa.index')}}">Etapas</a></li>
  <li class="breadcrumb-item active">Gestão de Etapas de GEPEX</li>
 
</ol>
  
    <div class="content">
    <h1 class="title-pg">Gestão de Etapas de GEPEX</h1>
@if(isset($errors)&& count($errors) >0)
<div class ="alert alert-danger">
    @foreach($errors->all() as $error )
    <p> {{$error}}</p>
    @endforeach
</div>
@endif

@if(isset($step))
<form class="form" method="post" action="{{route('etapa.update',$step->id)}}">
    {{ method_field('PUT')}}
    @else
    
<form id="form" class="form" method="post" action="{{route('etapa.store')}}">
    @endif
    {!! csrf_field() !!}
    <div class="row">
        
    <div class="form-group col-md-7">
        <label >Nome:</label><input type="text" autocomplete="off" name="name" required minlength="5" class="form-control" value="{{$step->name ?? ''}}">
    </div>
   
    </div>
     <div class="row">
   
     </div>
   
    
    <div class="row">
   <div class="form-group  col-md-3">
    <button class="btn btn-success">  <span class="glyphicon glyphicon-ok"></span> Enviar</button>
    <a  class="btn btn-danger" href="{{route('etapa.index')}}">
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