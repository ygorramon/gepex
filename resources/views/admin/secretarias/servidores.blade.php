@extends('adminlte::page')

@section('title', 'Gerência TI')

@section('content_header')

<div class="box">
    <ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
<li class="breadcrumb-item "><a href="{{route('secretaria.index')}}">Secretaria</a></li>
  <li class="breadcrumb-item active">Servidores</li>
 
</ol>
    <div class="box-header">
        <div class="row">
            <div class="col-sm-9">
                <h1> {{$secretary->name}}</h1>
            </div>
            <div class="col-sm-3" >
                <a  href="{{url("admin/secretaria/$secretary->id/editar-servidores")}}" class="btn btn-primary"> <i class="fa fa-user-plus"></i>&ensp;Adicionar Servidores</a>
                
            </div>
        </div>
    </div>
    <div class="content">
    <div class="row">
        
        <div class="col-sm-12 ">
            
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                    <tr role="row">
                        <th width="40%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Nome</th>
                        
                        
                                           </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr role="row" class="odd">
                        <td>{{$user->name}} </td>
                        
                        
                       
                    </tr>
                    @empty
                    <tr><td colspan="3">Nenhum Servidor encontrado</td></tr>
                    @endforelse
                </tbody>

            </table>  
        </div>
    </div>
      
</div>
</div>





@stop
