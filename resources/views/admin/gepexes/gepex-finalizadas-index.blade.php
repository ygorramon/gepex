@extends('adminlte::page')


@section('content_header')
<div class="card">

        <div class="card-body">
<div class="box">
    <ol class="breadcrumb">
   <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active">GEPEX - SECRETARIAS</li>
 
</ol>
    

    <div class="row content">
        <div class="col-sm-12 ">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                    <tr role="row" >
                        <th width="50%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Secretaria</th>
                        <th width="50%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Quantidade</th>
                        <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($secretaries as $secretary)
                    <tr role="row" class="odd" >
                        
                        <td > {{$secretary->name}} </td>
                        <td > {{$secretary->gepexes->where('status','FINALIZADO')->count()}} </td>
                       
                        
                        <td>
                         <a   href="{{route('gepex-finalizadas-secretarias', $secretary->id)}}"
                                    class="btn btn-info">
                                    <span class="glyphicon glyphicon-hand-up"></span> Acessar</a>
                                                       
                            
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3">Nenhuma Secretária encontrada para esse perfil</td></tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
    
</div>
        </div>
</div>
@stop

