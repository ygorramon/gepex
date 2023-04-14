@extends('adminlte::page')

@section('title', 'GEPEX')

@section('content_header')
    <div class="card">

        <div class="card-body">
            <div class="box">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('gepex.index') }}">GEPEX's</a></li>
                    <li class="breadcrumb-item active">Gestão de GEPEX's</li>

                </ol>

                <div class="content">
<form  method="post" action="{{route('gepex-enumerar-etapas-store',$gepex->id)}}">
     {!! csrf_field() !!}
                    <h1 class="title-pg">Dados da GEPEX - {{ $gepex->uid }}</h1>

                    <label>Necessidade</label>
                    <textarea class="form-control" disabled>{{ $gepex->needs }}</textarea>
                    <label>Etapas</label>
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                        aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th >ETAPA</th>
                                    
                                <th >Ordem</th>
                                <th >Alterar</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($steps as $step)
                                <tr role="row" class="odd">

                                    <td> {{ $step->name }} </td>
                                    <td> {{ $step->pivot->order }} </td>
                                  

                                    <td>
                                      <select class="form-control" name="ordem[{{$step->id}}]">
                                         <option disable value="">Selecione</option>
                                       @foreach ($steps as $key => $step)
                                           <option 
                                           
                                           value="{{$key+1}}">{{$key+1}}</option>
                                       @endforeach
                                      
                                      </select>
                      

                                    </td>
                                </tr>
                            @empty
                               
                            @endforelse
                        </tbody>

                    </table>
                    <button type="submit" class=" btn btn-primary">Enviar</button>
                </form>
                </div>
            </div>
        </div>


    @stop
