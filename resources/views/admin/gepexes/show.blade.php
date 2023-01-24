@extends('adminlte::page')


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
    <h1 class="title-pg">Dados da GEPEX - {{$gepex->uid}}</h1>
   
    <label>Necessidade</label>
    <textarea class="form-control" disabled>{{$gepex->needs}}</textarea>
  
  
      <label>STATUS</label>
    <textarea class="form-control" disabled>{{$gepex->status}}</textarea>
      <label>Data de Conclusão</label>
    <input class="form-control" type="date" disabled value="{{ $gepex->completion_date}}">
    <label>Observações</label>
    <textarea class="form-control" disabled>{{$gepex->obs}}</textarea>
     </div>

     
</div>
</div>


@stop