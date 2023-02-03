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
                        <h3>GEPEX EM EXECUÇÃO</h3>
                        
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                            aria-describedby="example2_info">
                            <thead>
                                <tr role="row">
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        GEPEX</th>
                                    <th width="50%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        NECESSIDADE</th>
                                        <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        SECRETARIA</th>
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        STATUS</th>
                                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        NÍVEL</th>

                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
                                        aria-label="Action: activate to sort column ascending">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gepexes as $gepex)
                                    <tr role="row" class="odd">

                                        <td> {{ $gepex->uid }} </td>
                                        <td> {{ $gepex->needs }} </td>
                                        <td> {{ $gepex->secretary->name }} </td>
                                        <td> <span
                                                class="badge {{ setStatus($gepex->status)->color }}">{{ setStatus($gepex->status)->value }}</span>
                                            @if($gepex->status=='APROVADO')
                                        <b>Quantidade de Etapas:</b> {{count($gepex->steps)}}
                                        @endif
                                        </td> </td>
                                        <td> <span class="badge {{ setPriority($gepex->priority)->color }}">{{ setPriority($gepex->priority)->value }}</span> 
                                        
                                        <td>
                                            @if($gepex->status=='ENVIADO')
                                            <a href="{{route('gepex-analise',$gepex->id)}}" class="btn btn-info">
                                                <span class="glyphicon glyphicon-hand-up"></span> Analisar</a>
                                                @endif
                                          
                                               
                                            <a href="{{route('gepex-defenir-etapas',$gepex->id)}}" class="btn btn-info">
                                                <span class="glyphicon glyphicon-hand-up"></span> Redefinir Etapas / Prazo</a>

                                               

                                        </td>
                                       
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
