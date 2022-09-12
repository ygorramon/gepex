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
                    <h1 class="title-pg">Dados da GEPEX - {{ $gepex->uid }}</h1>

                    <label>Necessidade</label>
                    <textarea class="form-control" disabled>{{ $gepex->needs }}</textarea>
                    <label>Etapas</label>
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                        aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th >Etapa</th>
                                    
                                <th >Situação</th>
                                <th >Data de Conclusão</th>
                                <th >Observações</th>

                                <th >Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($steps as $step)
                                <tr role="row" class="odd">

                                    <td> {{ $step->name }} </td>
                                  <td> <span class="badge {{ setfinished($step->pivot->finished)->color }}">{{ setfinished($step->pivot->finished)->value }} </span></td>
                                  <td> @if(isset($step->pivot->completion_date)){{ setDate($step->pivot->completion_date) }} @endif </td>
                                  <td> {{$step->pivot->obs}} </td>

                                    <td>
                                      
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal{{$step->id}}">
                           SITUAÇÃO DA ETAPA
                        </button>
                        
                        <div class="modal fade" id="modal{{$step->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{route('concluir-etapa',[$gepex->id, $step->id])}}" method="post">
                                    {!! csrf_field() !!}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">SITUAÇÃO DA ETAPA </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <label>Concluído:</label>
                                            <select name="finished" class="form-control" required>
                                                <option value="">Selecione</option>

                                                <option  value=" 1" >SIM</option>
                                                <option  value="2">EM PARTES</option>


                                            </select><label> Data de Atualização</label>
                                            <input class="form-control" name="completion_date" type="date" required>
                                            <label>Observações</label>
                                            <textarea name="obs" class="form-control"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button  class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">ENVIAR</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        

                                    </td>
                                </tr>
                            @empty
                               
                            @endforelse
                        </tbody>

                    </table>

                </div>
            </div>
        </div>


    @stop
