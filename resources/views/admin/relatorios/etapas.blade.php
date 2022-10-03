@extends('adminlte::page')


@section('content_header')
    <div class="card">

        <div class="card-body">
            <div class="box">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                  

                </ol>


                <div class="row content">
                                        <div class="col-sm-12 ">
                        <div class="card">
                            <div class="card-body">
                                <h3>Etapas</h3>
                                <form class="form-inline" action="{{ route('relatorios.search_etapas_todas') }}" method="post">
                                    @csrf
                                   
                                    <div class="form-group mb-2">
                                        <label for="id">ID</label>
                                        <input type="text" class="form-control" placeholder="XXX-999999" name="uid" value="{{$request->uid ?? ''}}">
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">

                                        <label> STATUS</label> <select name="finished" class="form-control">
                                            <option value="">Selecione</option>
                                            <option @if(isset($request) && $request->finished=='1') selected @endif value="1">COMPLETA</option>
                                            <option @if(isset($request) && $request->finished=='0') selected @endif value=0>INCOMPLETA</option>
                                            <option @if(isset($request) && $request->finished=='2') selected @endif value="2">EM EXECUÇÃO</option>
                                           

                                        </select>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">

                                        <label> Nível</label> <select name="priority" class="form-control">
                                            <option value="">Selecione</option>
                                            <option @if(isset($request) && $request->priority=='1') selected @endif value="1">SETORIAL</option>
                                            <option @if(isset($request) && $request->priority=='2') selected @endif value="2">PRIORITÁRIO</option>


                                        </select>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">

                                        <label> Secretaria</label> <select name="secretary_id" class="form-control">
                                             <option value="">Selecione</option>
                                            @foreach($secretaries as $secretary)
                                           
                                            <option @if(isset($request) && $secretary->id == $request->secretary_id) selected @endif value="{{$secretary->id}}">{{$secretary->name}}</option>
                                            
                                            @endforeach

                                        </select>
                                    </div>
                                 
                                    
                                    <button type="submit" class="btn btn-success" class="form-control">Filtrar</button>
                                </form>



                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 ">
                      
                        
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                            aria-describedby="example2_info">
                            <thead>
                                <tr role="row">
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        ID GEPEX</th>
                                    <th width="50%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        Necessidade</th>
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        Prioridade</th>
                                        <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        Secretaria</th>
                                        <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        ETAPA</th>
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        STATUS</th>
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        PREVISÃO DE CONCLUSÃO</th>

                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
                                        aria-label="Action: activate to sort column ascending">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gepex_steps as $gepex_step)
                                    <tr role="row" class="odd">

                                        <td> {{ $gepex_step->gepex->uid }} </td>
                                        <td> {{$gepex_step->gepex->needs }} </td>
                                        <td> <span class="badge {{ setPriority($gepex_step->gepex->priority)->color }}">{{ setPriority($gepex_step->gepex->priority)->value }}</span> 
                                        <td> {{ $gepex_step->gepex->secretary->name }} </td>
                                        <td>  {{ $gepex_step->step->name }} </td>
                                        <td> <span class="badge {{ setfinished($gepex_step->finished)->color }}">{{ setfinished($gepex_step->finished)->value }} </span> 
                                        @if($gepex_step->finished==1) <br> {{setDate($gepex_step->completion_date)}} @endif </td>
                                        <td>
                                            @if($gepex_step->finished != 1)  
                                            <span class="badge {{ setDateConclusion($gepex_step->prevision_date)->color }}"> {{ setDateConclusion($gepex_step->prevision_date)->value }} </span>
                                            @endif
                                            @if($gepex_step->finished == 1)  
                                            {{ setDateConclusion($gepex_step->prevision_date)->value }} 
                                            @endif
                                            </td>
                                       <td>  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal{{$gepex_step->id}}">
                           Mudar Previsão de Conclusão
                        </button> </td>
                                      
                        
                        <div class="modal fade" id="modal{{$gepex_step->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{route('nova-data-etapa',[$gepex_step->gepex->id, $gepex_step->id])}}" method="post">
                                    {!! csrf_field() !!}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Mudar Data de Conclusão </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <label> Nova Data</label>
                                            <input class="form-control" name="prevision_date" type="date" required>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button  class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">ENVIAR</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Nenhuma GEPEX encontrada para essa Secretaria</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
