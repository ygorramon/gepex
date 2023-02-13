@extends('adminlte::page')

@section('title', 'GEPEX')

@section('content_header')
<div class="card">

        <div class="card-body">
<div class="box">
     <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item "><a href="{{route('gepex.index')}}">GEPEX's</a></li>
  <li class="breadcrumb-item active">Gestão de GEPEX</li>
 
</ol>
  
    <div class="content">
    <h1 class="title-pg">Gestão de GEPEX'S</h1>
@if(isset($errors)&& count($errors) >0)
<div class ="alert alert-danger">
    @foreach($errors->all() as $error )
    <p> {{$error}}</p>
    @endforeach
</div>
@endif
@if(isset($gepex))
<form class="form" method="post" action="{{route('gepex.update', $gepex->id)}}">
    {{ method_field('PUT')}}
    @else
    
<form id="form" class="form" method="post" action="{{route('gepex-secretaria-store',$secretary->id)}}">
    @endif
    {!! csrf_field() !!}
    <div class="row">
        
    <div class="form-group col-md-6">
        <label >SECRETARIA:</label><input type="text" disabled="true" autocomplete="off" name="name"  minlength="5" class="form-control" value="{{$secretary->name ?? $gepex->secretary->name}}" >
    </div>
    <div class="form-group col-md-3">
        <label >DATA PARA CONCLUSÃO:</label><input type="date"  autocomplete="off" name="completion_date"  minlength="5" class="form-control" value="{{$gepex->completion_date ?? ''}}">
    </div>
    
        
    <div class="form-group col-md-3">
        <label >NÍVEL DE PRIORIDADADE:</label>
       <select name="priority" class="form-control">
                <option value="" >Selecione</option>
        
        <option @if (isset($gepex) && $gepex->priority==1) selected @endif value="1" style="background-color:	rgb(230,230,250); color:black">NORMAL</option>
        <option @if (isset($gepex) && $gepex->priority==2) selected @endif value="2" style="background-color:rgb(0, 0, 255); color:black">MÉDIO</option>
        <option @if (isset($gepex) && $gepex->priority==3) selected @endif value="3" style="background-color:rgb(255, 0, 0); color:black">MÁXIMO</option>
        

            </select> 
    </div>
   
   
    </div>
    <div class="row">
        <div class="form-group col-md-3">
        <label >ORÇAMENTO APROXIMADO:</label>
        <input type="text" id="price" name="price" autocomplete="off" required minlength="5" class="form-control" value="{{$gepex->price ?? ''}}">
    </div>
    <div class="form-group col-md-12">
        <label >DESCRIÇÃO DA GEPEX:</label>
        <textarea  rows="10"  name="needs"  class="form-control">{{$gepex->needs ?? '' }}</textarea>
    </div>
   
   
   
    </div>
    
<div class="row">
   <div class="form-group  col-md-3">
    <button class="btn btn-success">  <span class="glyphicon glyphicon-ok"></span> Salvar</button>
    
    </div>
    </div>

    </div>
</div>
@section('js')
<script>
$(document).ready(function(){
  $('#price').inputmask({ alias: "currency", radixPoint:"," });  //static mask
 
});

</script>
@endsection

@stop