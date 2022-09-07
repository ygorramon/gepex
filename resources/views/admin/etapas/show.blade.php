@extends('adminlte::page')

@section('title', 'Gerência TI')

@section('content_header')
<div class="box">

    <ol class="breadcrumb">
   <li class="breadcrumb-item"><a href="/home">Home</a></li>
  <li class="breadcrumb-item "><a href="/admin/etapa">Etpas de GEPEX</a></li>
  <li class="breadcrumb-item active">Visualizar Etapa de GEPEX</li>
 
</ol>
    <div class="container">
<div class="row">
        
    <div class="form-group col-md-7">
        <label >Nome:</label><input type="text" disabled="true" name="nome"  class="form-control" value="{{$step->name }}">
    </div>
   
    </div>
    <div class="row">
        
    <div class="form-group col-md-12">
        <label >Descrição da Etapa:</label>
        <textarea  rows="10"  name="description" required="" disabled="true" class="form-control">{{$step->description ?? ''}}</textarea>
    </div>
   
    </div>
  
    <div class="row">
    
          <hr>
<form class="form" method="post" action="{{route('etapa.destroy',$step->id)}}" onsubmit = "return confirm('Confirmar apagar?')">
    {{ method_field('DELETE')}}
    {!! csrf_field() !!}
     
     <a  href="{{route('etapa.edit',$step->id)}}"
                class="btn  btn-success">
         <span class="glyphicon glyphicon-pencil"></span>&ensp;Editar

            </a>
    <button class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>&ensp;Deletar</button>
     <a  class="btn btn-warning" href="{{route('etapa.index')}}">
         <span class="glyphicon glyphicon-remove"></span>&ensp;Cancelar
            </a>
</form>
          <br>
</div>
</div>

@stop
