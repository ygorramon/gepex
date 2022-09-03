@extends('adminlte::page')

@section('title', 'Gerência TI')
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .modal-header, h4, .close {
        background-color: #5cb85c;
        color:white !important;
        text-align: center;
        font-size: 30px;
    }
    .modal-footer {
        background-color: #f9f9f9;
    }
</style>
@endsection
@section('content_header')
<div class="box">

    <ol class="breadcrumb">
   <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item "><a href="{{route('produtos.index')}}">Produtos</a></li>
  <li class="breadcrumb-item active">Vizualizar Produto</li>
 
</ol>
    <div class="container">
        <div class="row">
       <div class="form-group col-md-6">
        <label >Nome:</label><input type="text" name="nome"  class="form-control" value="{{$produto->nome or old('nome')}}">
    </div>
        <div class="form-group col-md-2">
       <label>Unidade de Medida</label>
   <input type="text" name="tipo"  class="form-control" value="{{$produto->tipo or old('nome')}}">
    </div>
        </div>
    <div class="row">
    <div class="form-group col-md-8">
        <label >Descrição (Detalhado):</label><textarea maxlength="255" rows="15" name="descricao" required="" class="form-control">{{$produto->descricao or old('descricao')}}</textarea>
    </div>  
    </div> 
        <div class="row">
    <div class="form-group col-md-3">
       <label>Modelo de Referência</label>
   <input type="text" name="referencia"  class="form-control" value="{{$produto->referencia or old('referencia')}}">
   
    </div>
    <div class="form-group col-md-3">
       <label>Imagem</label>
     
   <a href="#" class="linkanexo">{{$produto->foto}}</a> 
    </div>
            </div>
        <div class="row">
    <div class="form-group col-md-3">
       <label>Tipo</label>
   <input type="text" name="capital_custeio"  class="form-control" value="{{$produto->capital_custeio or old('capital_custeio')}}">
    </div>
    <div class="form-group col-md-3">
       <label>Categoria</label>
   <input type="text" name="categoria"  class="form-control" value="{{$produto->categoria or old('categoria')}}">
    </div>
        </div>
    
    
         
    
     <div class="row">
   <div class="form-group col-md-8">
          <hr>
           </div>  
         </div> 
<form class="form" method="post" action="{{route('produtos.destroy',$produto->id)}}" onsubmit = "return confirm('Confirmar apagar?')">
    {{ method_field('DELETE')}}
    {!! csrf_field() !!}
     
     <a  href="{{route('produtos.edit',$produto->id)}}"
                class="btn  btn-warning">
         <span class="glyphicon glyphicon-pencil"></span>&ensp;Editar

            </a>
    <button class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>&ensp;Deletar</button>
     <a  class="btn btn-primary" href="{{route('produtos.index')}}">
         <span class="glyphicon glyphicon-home"></span>&ensp;Cancelar
            </a>
</form>
          <br>
</div>
</div>



<div class="modal fade " id="myModal" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body" >
                <iframe id="iframeFile" width="100%" height="600"></iframe>
            </div>
        </div>
    </div>
</div>


@section('js')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    
     $(document).ready(function () {
        
        $(".linkanexo").click(function (event) {
           event.preventDefault();
         
        $file = event.target.innerText;
       
            $("#iframeFile").attr('src', '/files/'.concat($file));
          
            $("#myModal").modal();
        });
    });
</script>
@endsection
@stop
