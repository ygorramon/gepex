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
                                <h3>GEPEX's</h3>
                                <form class="form-inline" action="{{ route('gepex.search_todas') }}" method="post">
                                    @csrf
                                   
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

                                        <label> Secretaria</label> <select name="secretary_id" class="form-control">
                                             <option value="">Selecione</option>
                                            @foreach($secretaries as $secretary)
                                           
                                            <option @if(isset($request) && $secretary->id == $request->secretary_id) selected @endif value="{{$secretary->id}}">{{$secretary->name}}</option>
                                            
                                            @endforeach

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
                    <div class="col-sm-12 ">
                      
                        
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
                                        Secretaria</th>
                                        <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">
                                        Previsão de Conclusão</th>
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
                                        <td> {{ $gepex->secretary->name }} </td>
                                        <td> <span class="badge {{ setDateConclusion($gepex->completion_date)->color }}"> {{ setDateConclusion($gepex->completion_date)->value }} </td>
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
                                            @if($gepex->status=='APROVADO')
                                               
                                            <a href="{{route('gepex-defenir-etapas',$gepex->id)}}" class="btn btn-info">
                                                <span class="glyphicon glyphicon-hand-up"></span> Definir Etapas</a>

                                                @endif

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
