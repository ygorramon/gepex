@extends('adminlte::page')


@section('content_header')
<div class="card">

        <div class="card-body">
<div class="box">
    <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active">Usuários</li>
 
</ol>
    <div class="box-header">
        <div class="row">
            
            <div class="col-sm-3" >
                <a  href="{{url('usuario/create')}}" class="btn btn-primary"> <i class="fa fa-user-plus"></i>&ensp;Adicionar Usuário </a>
            </div>
        </div>
    </div>
    <div class="content">
    <div class="row">
        <div class="col-sm-12">
            <table id="example" class="table table-condensed">
                <thead>
                    <tr role="row">
                        <th width="10%" >ID</th>
                        <th width="70%">Nome</th>
                      
                        <th >Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    @if(isset($user->aluno->nome))
                    @else
                    <tr role="row" class="odd">
                        <td>{{$user->id}} </td>
                        <td>{{$user->name}} </td>
                       
                        
                        <td>
                            <a  href="{{route('usuario.show',$user->id)}}"
                                class="btn btn-sm btn-success " >
                                <span class="glyphicon glyphicon-eye-open"></span> Visualizar</a>
                            </a>
                            <a  href="{{route('usuario.edit',$user->id)}}"
                                class="btn btn-sm btn-warning">
                                <span class="glyphicon glyphicon-pencil"></span>Editar

                            </a>
                        </td>
                    </tr>
                    @endif
                    @empty
                    <tr><td colspan="3">Nenhum Usuário encontrado</td></tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
    </div>
    <div class="row">
        
        <div class="col-sm-8">
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

