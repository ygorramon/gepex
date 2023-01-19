@extends('adminlte::page')


@section('content_header')
    <div class="card">

        <div class="card-body">
            <div class="box">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">GEPEX da SECRETARIA - {{ $secretary->name }}</li>

                </ol>

                <div class="col-sm">

                    <a href="{{ route('gepex-secretaria-create', $secretary->id) }}" class="btn btn-primary"> <i
                            class="fa fa-user-plus"></i>&ensp;Adicionar
                        GEPEX
                    </a>
                </div>

                <div class="row content">
                    <div class="col-sm-12 ">
                        <div class="card">
                            <div class="card-body">
                                <h3>GEPEX's - {{ $secretary->name }}</h3>
                                <form class="form-inline" action="{{ route('gepex.search') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="secretary_id" value="{{$secretary->id}}" ">
                                    <div class="form-group mb-2">
                                        <label for="id">ID</label>
                                        <input type="text" class="form-control" placeholder="XXX-999999" name="uid" value="{{$request->uid ?? ''}}">
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">

                                        <label> STATUS</label> <select name="status" class="form-control">
                                            <option value="">Selecione</option>
                                            <option @if(isset($request) && $request->status=='LANÇADO') selected @endif value="LANÇADO">LANÇADO</option>
                                            <option @if(isset($request) && $request->status=='ENVIADO') selected @endif value="ENVIADO">ENVIADO</option>
                                            <option @if(isset($request) && $request->status=='APROVADO') selected @endif value="APROVADO">APROVADO</option>
                                            <option @if(isset($request) && $request->status=='DEVOLVIDO') selected @endif value="DEVOLVIDO">DEVOLVIDO</option>
                                            <option @if(isset($request) && $request->status=='EM EXECUÇÃO') selected @endif value="EM EXECUÇÃO">EM EXECUÇÃO</option>
                                            <option @if(isset($request) && $request->status=='CANCELADO') selected @endif value="CANCELADO">CANCELADO</option>
                                            <option @if(isset($request) && $request->status=='FINALIZADO') selected @endif value="FINALIZADO">FINALIZADO</option>

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

                                        <label> De</label>
                                        <input type="date" name="data_inicio" class="form-control" value="{{$request->data_inicio ?? ''}}">
                                        <label> Até</label>
                                        <input type="date" name="data_fim" class="form-control"  value="{{$request->data_fim ?? ''}}">
                                    </div>
                                    <button type="submit" class="btn btn-success" class="form-control">Filtrar</button>
                                </form>



                            </div>
                        </div>
                    </div>
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                        aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="city: activate to sort column ascending">
                                    GEPEXS</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="city: activate to sort column ascending">
                                    Necessidade</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="city: activate to sort column ascending">
                                    STATUS</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="city: activate to sort column ascending">
                                    Nível</th>

                                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
                                    aria-label="Action: activate to sort column ascending">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gepexes as $gepex)
                                <tr role="row" class="odd">

                                    <td> {{ $gepex->uid }} <br>
                                        <b>Criado em:</b> {{ setDate($gepex->created_at) }}
                                    </td>
                                    <td> {{ $gepex->needs }} </td>

                                    <td> <span
                                            class="badge {{ setStatus($gepex->status)->color }}">{{ setStatus($gepex->status)->value }}</span>
                                        <br>
                                        @if ($gepex->status == 'EM EXECUÇÃO' || $gepex->status == 'FINALIZADO')
                                            <div class="progress-group">
                                                Etapas Completas <span
                                                    class="float-right"><b>{{ count($gepex->steps->where('pivot.finished', '=', 1)) }}</b>/{{ count($gepex->steps) }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success"
                                                        style="width: {{ percent($gepex) }}%"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td> <span
                                            class="badge {{ setPriority($gepex->priority)->color }}">{{ setPriority($gepex->priority)->value }}</span>
                                    </td>
                                    <td>
                                      


                                        <a href="{{ route('gepex.show', $gepex->id) }}" class="btn btn-info">
                                            <span class="glyphicon glyphicon-hand-up"></span> Visualizar</a>



                                    </td>



                                    @if (($gepex->status == 'LANÇADO' || $gepex->status == 'DEVOLVIDO'))
                                        <td>
                                            <form action="{{ route('gepex-enviar-para-aprovacao', $gepex->id) }}"
                                                method="post">
                                                {!! csrf_field() !!}
                                                <button class="btn btn-primary"> Enviar para Aprovação</button>
                                            </form>


                                        </td>
                                    @endif
                                    @if ($gepex->status == 'APROVADO' && count($gepex->steps)>0)
                                        <td>
                                            <form action="{{ route('gepex-iniciar-execucao', $gepex->id) }}"
                                                method="post">
                                                {!! csrf_field() !!}
                                                <button class="btn btn-primary"> Iniciar Execução</button>
                                            </form>
                                        </td>
                                    @endif
                                    @if ($gepex->status == 'EM EXECUÇÃO' || $gepex->status == 'FINALIZADO')
                                        <td>

                                            <a href="{{ route('gepex-ver-etapas', $gepex->id) }}" class="btn btn-info">
                                                <span class="glyphicon glyphicon-hand-up"></span> Ver Etapas</a>
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#modal{{ $gepex->id }}">
                                                VISUALIZAR TIMELINE
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                                <div class="modal fade" id="modal{{ $gepex->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">GEPEX -
                                                    {{ $gepex->uid }} </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Main node for this component -->
                                                <div class="timeline">
                                                    <!-- Timeline time label -->

                                                    <div>
                                                        <!-- Before each timeline item corresponds to one icon on the left scale -->
                                                        <i class="fas fa-check bg-green"></i>
                                                        <!-- Timeline item -->
                                                        <div class="timeline-item">
                                                            <!-- Time -->
                                                            <!-- Header. Optional -->
                                                            <h3 class="timeline-header"> Lançamento da GEPEX</h3>
                                                            <div class="timeline-body">
                                                                <b>Concluído em: </b> {{ setDate($gepex->created_at) }}
                                                            </div>
                                                            <!-- Placement of additional controls. Optional -->

                                                        </div>
                                                    </div>
                                                    @forelse($gepex->steps as $step)
                                                        <div>
                                                            @if ($step->pivot->finished == 1)
                                                                <!-- Before each timeline item corresponds to one icon on the left scale -->
                                                                <i class="fas fa-check bg-green"></i>
                                                                <!-- Timeline item -->
                                                                <div class="timeline-item">
                                                                    <!-- Time -->
                                                                    <!-- Header. Optional -->
                                                                    <h3 class="timeline-header"> {{ $step->name }}
                                                                    </h3>
                                                                    <div class="timeline-body">
                                                                        @if (isset($step->pivot->completion_date))
                                                                            <b>Concluído em: </b>
                                                                            {{ setDate($step->pivot->completion_date) }}
                                                                            <br>
                                                                        @endif
                                                                        @if (isset($step->pivot->obs))
                                                                            <b>Observações: </b>{{ $step->pivot->obs }}
                                                                        @endif
                                                                    </div>
                                                                    <!-- Placement of additional controls. Optional -->

                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            @if ($step->pivot->finished == 0)
                                                                <!-- Before each timeline item corresponds to one icon on the left scale -->
                                                                <i class="fas fa-times bg-red"></i>
                                                                <!-- Timeline item -->
                                                                <div class="timeline-item">
                                                                    <!-- Time -->
                                                                    <!-- Header. Optional -->
                                                                    <h3 class="timeline-header">{{ $step->name }}
                                                                    </h3>

                                                                    <!-- Placement of additional controls. Optional -->

                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            @if ($step->pivot->finished == 2)
                                                                <!-- Before each timeline item corresponds to one icon on the left scale -->
                                                                <i class="fas fa-times bg-yellow"></i>
                                                                <!-- Timeline item -->
                                                                <div class="timeline-item">
                                                                    <!-- Time -->
                                                                    <!-- Header. Optional -->
                                                                    <h3 class="timeline-header">{{ $step->name }}
                                                                    </h3>
                                                                    @if (isset($step->pivot->completion_date))
                                                                        <div class="timeline-body">
                                                                            <b>Última Atualização em: </b>
                                                                            {{ setDate($step->pivot->completion_date) }}
                                                                            <br>
                                                                    @endif
                                                                    @if (isset($step->pivot->obs))
                                                                        <b>Observações: </b>{{ $step->pivot->obs }}
                                                                    @endif
                                                                </div>
                                                                <!-- Placement of additional controls. Optional -->

                                                        </div>
                                                    @endif
                                                </div>
                                            @empty
                            @endforelse
                            <!-- The last icon means the story is complete -->
                            <div>
                            </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>

            </div>

        </div>
    </div>
    </div>
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
