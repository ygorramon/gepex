@extends('adminlte::page')

@section('title', 'COMPRAS TI')

@section('content_header')
    <div class="card">

        <div class="card-body">
            <div class="box">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">GEPEX da SECRETARIA - {{ $secretary->name }}</li>

                </ol>


                <div class="row content">
                    <div class="col-sm-12 ">
                        <h3>GEPEX's - {{ $secretary->name }}</h3>
                        <div class="col-sm-3">
                            <a href="{{ route('gepex-secretaria-create', $secretary->id) }}" class="btn btn-primary"> <i
                                    class="fa fa-user-plus"></i>&ensp;Adicionar GEPEX </a>
                        </div>
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                            aria-describedby="example2_info">
                            <thead>
                                <tr role="row">
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        GEPEXS</th>
                                    <th width="50%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        Necessidade</th>
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        STATUS</th>
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        Nível</th>

                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
                                        aria-label="Action: activate to sort column ascending">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gepexes as $gepex)
                                    <tr role="row" class="odd">

                                        <td> {{ $gepex->uid }} </td>
                                        <td> {{ $gepex->needs }} </td>
                                        <td> {{ $gepex->status }} </td>
                                        <td> <span
                                                class="badge {{ setPriority($gepex->priority)->color }}">{{ setPriority($gepex->priority)->value }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('gepex.show', $gepex->id) }}" class="btn btn-info">
                                                <span class="glyphicon glyphicon-hand-up"></span> Visualizar</a>


                                        </td>
                                        @if ($gepex->status == 'INICIADO')
                                            <td>
                                                <form action="{{ route('gepex-enviar-aprovacao', $gepex->id) }}"
                                                    method="post" class="form-group">
                                                    {!! csrf_field() !!}
                                                    <button class=" btn btn-primary"> Enviar para Aprovação</button>
                                                </form>

                                            </td>
                                        @endif
                                        @if ($gepex->status == 'APROVADO')
                                            <td>
                                                <a href="{{ route('gepex-defenir-etapas', $gepex->id) }}" class="btn btn-info">
                                                    <span class="glyphicon glyphicon-hand-up"></span> Planejar Etapas</a>
                                            </td>
                                        @endif
                                         @if ($gepex->status == 'Em Construção')
                                            <td>
                                                <a href="{{ route('gepex-ver-etapas', $gepex->id) }}" class="btn btn-info">
                                                    <span class="glyphicon glyphicon-hand-up"></span> Ver Etapas</a>
                                            </td>
                                        @endif
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
