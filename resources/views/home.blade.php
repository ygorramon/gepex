@extends('adminlte::page')

@section('title', 'GEPEX')

@section('content_header')
  
   
@stop

@section('content')
 <div class="card content">
<div class="row">
<div class="col-lg-3 col-6">

<div class="small-box bg-info">
<div class="inner">
<h3>GEPEX</h3>
<p>Minhas GEPEXs</p>
</div>
<div class="icon">
<i class="fas fa-folder"></i>
</div>
<a href="{{route('gepex.index')}}" class="small-box-footer">
Acessar <i class="fas fa-arrow-circle-right"></i>
 </a>
</div>
</div>
@can('secretaria')
<div class="col-lg-3 col-6">

<div class="small-box bg-success">
<div class="inner">
<h3>{{App\Models\Gepex::where('status', 'ENVIADO')->count()}}</h3>
<p>GEPEX ENVIADAS</p>
</div>
<div class="icon">
<i class="fas fa-upload"></i>
</div>
<a href="{{route('gepex-enviadas')}}" class="small-box-footer">
Acessar <i class="fas fa-arrow-circle-right"></i>
</a>
</div>
</div>
@endcan

@can('prefeito')
<div class="col-lg-3 col-6">

<div class="small-box bg-warning">
<div class="inner">
<h3>{{App\Models\Gepex::where('status', 'APROVADO')->count()}}</h3>
<p>GEPEX APROVADAS</p>
</div>
<div class="icon">
<i class="fas fa-download"></i>
</div>
<a href="{{route('gepex-aprovacao')}}" class="small-box-footer">
Acessar <i class="fas fa-arrow-circle-right"></i>
</a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-danger">
<div class="inner">
<h3>{{App\Models\Gepex::where('status', 'EM EXECUÇÃO')->count()}}</h3>
<p>GEPEX EM EXECUÇÃO</p>
</div>
<div class="icon">
<i class="fas fa-upload"></i>
</div>
<a href="{{route('gepex-execucao')}}" class="small-box-footer">
Acessar <i class="fas fa-arrow-circle-right"></i>
</a>
</div>
</div>
@endcan
</div>

<div class="card container">
   <center> <img src="{{url('/imgs/logo1.png')}}" width="30%"> </center>
</div>
 </div>
@endsection
