@extends('adminlte::page')

@section('title', 'GEPEX')

@section('content_header')
 <div class="card">

        <div class="card-body">
<div class="box">
    <ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
<li class="breadcrumb-item active">Secretarias</li>
 
</ol>
    <div class="box-header">
        <div class="row">
            <div class="col-sm-9">
                <a  href="{{url('admin/secretaria/create')}}" class="btn btn-primary"> <i class="fa fa-user-plus"></i>&ensp;Adicionar secretaria </a>
            </div>
            
        </div>
    </div>

    <div class="row content">
        <div class="col-sm-12">
            <table id="example" class="table table-condensed">
                <thead>
                    <tr role="row">
                        <th>id</th>
                        <th>Secretaria</th>
                         <th>SIGLA</th>
                        <th >Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($secretaries as $secretary)
                      
                    <tr><td>{{$secretary->id}}</td>
                        <td>{{$secretary->name}}</td>
                                                <td>{{$secretary->initials}}</td>

                        <td>
                            <form class="form" method="post" action="{{route('secretaria.destroy',$secretary->id)}}" onsubmit = "return confirm('Confirmar apagar?')">
    {{ method_field('DELETE')}}
    {!! csrf_field() !!} 
                            <a  href="{{route('secretaria.edit',$secretary->id)}}"
                                class="btn  btn-warning">
                                <span class="glyphicon glyphicon-pencil"></span>Editar

                            </a>
                          
                            <button class="btn btn-danger" > <span class="glyphicon glyphicon-trash"></span>&ensp;Deletar</button>
                            <a href="{{url("admin/secretaria/$secretary->id/servidores")}}"class="btn btn-primary">     <span class="glyphicon glyphicon-user"></span>Servidores</a></td>
     
</form>
    
                          
                            
                    </tr>
                    @empty<tr><td>Nenhuma Secretaria cadastrada</td></tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
    <div class="row">
        
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
          
        </div>
      </div>
</div>
        </div>
 </div>
@section('js')
<script type="text/javascript">
    $('#example').DataTable( {
      dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ], 
        
        
     "language": {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "Mostrando _MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}
} );
</script>

   @endsection
@stop

