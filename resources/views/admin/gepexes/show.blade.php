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
   <div class="row">
    <label>Necessidade</label>
    <textarea class="form-control" disabled>{{$gepex->needs}}</textarea>
   </div>
   <div class="row">
  <div class="col-sm-4">
      <label>STATUS</label>
    <input class="form-control" disabled value="{{$gepex->status}}">
  </div>
     <div class="col-sm-4">
      <label>DATA DE CONCLUSÃO</label>
    <input class="form-control" type="date" disabled value="{{ $gepex->completion_date}}">
     </div>
     <div class="col-sm-4">
      <label>ORÇAMENTO APROXIMADO</label>
    <input class="form-control" name="price" id="price" disabled  value="{{ $gepex->price}}">
     </div>
</div>
<div class="row"> 
    <label>OBSERVAÇÕES</label>
    <textarea class="form-control" disabled>{{$gepex->obs}}</textarea>
     </div>
      </div></div>
      </div>
      <div class="card container">

        <div class="card-body">
           <div class="row">
  <div class="col-sm-3">
          <a href="{{route('gepex.edit', $gepex->id)}}" class="btn btn-warning">EDITAR</a>
  </div>

  <!--
  <div class="col-sm-3">
          <form action="{{ route('gepex.destroy', $gepex->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETAR </button>
            </form>
  </div>
-->

</div>
        </div></div> 
  
    </div>


       
        
@section('js')
<script>
$(document).ready(function(){
  $('#price').inputmask({ alias: "currency", radixPoint:"," });  //static mask
 
});

</script>
@endsection

@stop