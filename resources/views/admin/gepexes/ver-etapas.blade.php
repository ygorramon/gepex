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
                                <th width="50%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="city: activate to sort column ascending">Etapa</th>
                                    
                                <th tabindex="0" aria-controls="example2" rowspan="1" 
                                    aria-label="Action: activate to sort column ascending">Situação</th>
                                <th tabindex="0" aria-controls="example2" rowspan="1" 
                                    aria-label="Action: activate to sort column ascending">Data de Conclusão</th>

                                <th tabindex="0" aria-controls="example2" rowspan="1" 
                                    aria-label="Action: activate to sort column ascending">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($steps as $step)
                                <tr role="row" class="odd">

                                    <td> {{ $step->name }} </td>
                                  <td> <span class="badge {{ setfinished($step->pivot->finished)->color }}">{{ setfinished($step->pivot->finished)->value }} </span></td>
                                  <td> {{ setDate($step->pivot->completion_date) }} </td>

                                    <td>
                                       <a class="btn btn-primary" href="{{route('concluir-etapa', [$gepex->id, $step->id])}}"> Concluir Etapa</a> 

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
