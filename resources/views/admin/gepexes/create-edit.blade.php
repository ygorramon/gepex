@extends('adminlte::page')

@section('title', 'GEPEX')

@section('content_header')
<div class="card">

        <div class="card-body">
<div class="box">
     <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item "><a href="{{route('gepex.index')}}">GEPEX's</a></li>
  <li class="breadcrumb-item active">Gestão de GEPEX's</li>
 
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
@if(isset($user))
<form class="form" method="post" action="">
    {{ method_field('PUT')}}
    @else
    
<form id="form" class="form" method="post" action="{{route('gepex-secretaria-store',$secretary->id)}}">
    @endif
    {!! csrf_field() !!}
    <div class="row">
        
    <div class="form-group col-md-6">
        <label >Secretaria:</label><input type="text" disabled="true" autocomplete="off" name="name" required minlength="5" class="form-control" value="{{$secretary->name}}" >
    </div>
    <div class="form-group col-md-3">
        <label >Data para conclusão:</label><input type="date"  autocomplete="off" name="completion_date" required minlength="5" class="form-control" >
    </div>
    
        
    <div class="form-group col-md-3">
        <label >Nível de Prioridade:</label>
       <select name="priority" class="form-control">
                <option ">Selecione</option>
        
        <option value="1" style="background-color:rgb(0, 0, 255); color:rgb(255, 255, 255)">NORMAL</option>
        <option value="2" style="background-color:rgb(255, 0, 0); color:black">MÉDIO</option>
        <option value="3" style="background-color:rgb(255, 0, 0); color:black">MÁXIMO</option>
        

            </select> 
    </div>
   
   
    </div>
    <div class="row">
        <div class="form-group col-md-3">
        <label >Orçamento aproximado:</label>
        <input type="text" id="price" name="price" autocomplete="off" name="name" required minlength="5" class="form-control" >
    </div>
    <div class="form-group col-md-12">
        <label >Descrição da GEPEX:</label>
        <textarea  rows="10"  name="need" required="" class="form-control">{{$gepex->need ?? ''}}</textarea>
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
  $('#price').inputmask({ alias: "currency", groupSeparator:false});  //static mask
 
});

</script>
@endsection

@stop