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
                    <h1 class="title-pg">DADOS DA GEPEX - {{ $gepex->uid }}</h1>

                    <label>NECESSIDADE</label>
                    <textarea class="form-control" disabled>{{ $gepex->needs }}</textarea>


                    <label>STATUS</label>
                    <textarea class="form-control" disabled>{{ $gepex->status }}</textarea>
                    <label>DATA DE CONCLUSÃO</label>
                    <input class="form-control" type="date" disabled value="{{ $gepex->completion_date }}">
                    <br>

                    <br>
                    <div class="card">

                        <div class="card-body">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#aprovarGepex">
                                Aprovar GEPEX
                            </button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#devolverGepex">
                                Devolver GEPEX
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelarGepex">
                                Cancelar GEPEX
                            </button>
                            <div class="modal fade" id="aprovarGepex" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('gepex-analise-post', $gepex->id) }}" method="post">
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Aprovar GEPEX</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <label>Nível de Prioridade:</label>
                                                <select name="priority" class="form-control" required>
                                                    <option value="">Selecione</option>

                                                    <option @if ($gepex->priority == 1) selected @endif value=" 1"
                                                       style="background-color:	rgb(230,230,250); color:black">
                                                        NORMAL</option>
                                                    <option @if ($gepex->priority == 2) selected @endif value="2"
                                                       style="background-color:rgb(0, 0, 255); color:black">MÉDIO</option>
                                                    <option @if ($gepex->priority == 3) selected @endif value="3"
                                                       style="background-color:rgb(255, 0, 0); color:black">MÁXIMO</option>


                                                </select>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Orçamento aproximado:</label>
                                                        <input type="text" id="price" name="price"
                                                            autocomplete="off" name="name" required minlength="5"
                                                            class="form-control" value="{{ $gepex->price ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Data para conclusão:</label><input type="date"
                                                            autocomplete="off" name="completion_date" required
                                                            minlength="5" class="form-control" value="{{ $gepex->completion_date ?? '' }}">
                                                    </div>
                                                </div>
                                                    <label>Observações</label>
                                                    <textarea name="obs" class="form-control"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    <button name="status" value="APROVADO"
                                                        class="btn btn-primary">ENVIAR</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="devolverGepex" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('gepex-analise-post', $gepex->id) }}" method="post">
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Cancelar GEPEX</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <label>Nível de Prioridade:</label>
                                                <select name="priority" class="form-control" required>
                                                    <option value="">Selecione</option>

                                                    <option @if ($gepex->priority == 1) selected @endif
                                                        value=" 1"
                                                        style="background-color:rgb(0, 0, 255); color:rgb(255, 255, 255)">
                                                        NORMAL</option>
                                                    <option @if ($gepex->priority == 2) selected @endif
                                                        value="2"
                                                        style="background-color:rgb(255, 0, 0); color:black">MÉDIO</option>
                                                    <option @if ($gepex->priority == 3) selected @endif
                                                        value="3"
                                                        style="background-color:rgb(255, 0, 0); color:black">MÁXIMO
                                                    </option>


                                                </select>
                                                  <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Orçamento aproximado:</label>
                                                        <input type="text" id="price" name="price"
                                                            autocomplete="off" name="name" required minlength="5"
                                                            class="form-control" value="{{ $gepex->price ?? '' }}">
                                                    </div>
                                                   <div class="form-group col-md-6">
                                                        <label>Data para conclusão:</label><input type="date"
                                                            autocomplete="off" name="completion_date" required
                                                            minlength="5" class="form-control" value="{{ $gepex->completion_date ?? '' }}">
                                                    </div>
                                                </div>
                                                <label>Observações</label>
                                                <textarea name="obs" class="form-control"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button name="status" value="DEVOLVIDO" class="btn btn-warning">Devolver
                                                    GEPEX</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="cancelarGepex" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('gepex-analise-post', $gepex->id) }}" method="post">
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Cancelar GEPEX</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <label>Nível de Prioridade:</label>
                                                <select name="priority" class="form-control" required>
                                                    <option value="">Selecione</option>

                                                    <option @if ($gepex->priority == 1) selected @endif
                                                        value=" 1"
                                                        style="background-color:rgb(0, 0, 255); color:rgb(255, 255, 255)">
                                                        NORMAL</option>
                                                    <option @if ($gepex->priority == 2) selected @endif
                                                        value="2"
                                                        style="background-color:rgb(255, 0, 0); color:black">MÉDIO</option>
                                                    <option @if ($gepex->priority == 3) selected @endif
                                                        value="3"
                                                        style="background-color:rgb(255, 0, 0); color:black">MÁXIMO
                                                    </option>


                                                </select>
                                                  <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Orçamento aproximado:</label>
                                                        <input type="text" id="price" name="price"
                                                            autocomplete="off" name="name" required minlength="5"
                                                            class="form-control" value="{{ $gepex->price ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Data para conclusão:</label><input type="date"
                                                            autocomplete="off" name="completion_date" required
                                                            minlength="5" class="form-control" value="{{ $gepex->completion_date ?? '' }}">
                                                    </div>
                                                </div>
                                                <label>Observações</label>
                                                <textarea name="obs" class="form-control"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button name="status" value="CANCELADO" class="btn btn-danger">Cancelar
                                                    GEPEX</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
    </div>

@section('js')
<script>
$(document).ready(function(){
  $('#price').inputmask({ alias: "currency", radixPoint:"," });  //static mask
 
});


</script>
@endsection
@stop
