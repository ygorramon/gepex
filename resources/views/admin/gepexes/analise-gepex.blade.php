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

                    <label>Objetivos</label>
                    <textarea class="form-control" disabled>{{ $gepex->goals }}</textarea>
                    <label>Estratégias</label>
                    <textarea class="form-control" disabled>{{ $gepex->strategies }}</textarea>
                    <label>STATUS</label>
                    <textarea class="form-control" disabled>{{ $gepex->status }}</textarea>
                    <label>Data de Conclusão</label>
                    <input class="form-control" type="date" disabled value="{{ $gepex->completion_date }}">
                    <br>
                    <div class="card">

                        <div class="card-body">
                            <label>Etapas Sugeridas</label>
                            @forelse($gepex->steps as $step)
                                <input class="form-control" disabled value="{{ $step->name }}"> <br>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <br>
                    <div class="card">

                        <div class="card-body">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#aprovarGepex">
                                Aprovar GEPEX
                            </button>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#devolverGepex">
                                Devolver GEPEX
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#cancelarGepex">
                                Cancelar GEPEX
                            </button>
                            <div class="modal fade" id="aprovarGepex" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form>
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Aprovar GEPEX</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Observações</label>
                                           <textarea name="obs" class="form-control"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Fechar</button>
                                            <button type="button" class="btn btn-primary">ENVIAR</button>
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

    @section('js')<script>
            $('#myModal').modal(options) <
                /abstract
        @endsection
    @stop
