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
                    <form action="{{ route('gepex-analise-post', $gepex->id) }}" method="post" class="form-group">
                        {!! csrf_field() !!}
                        <div class="row">

                            <div class="form-group col-md-3">
                                <label>Nível de Prioridade:</label>
                                <select name="priority" class="form-control">
                                    <option ">Selecione</option>
            <option value="1" @if ($gepex->priority == 1) selected @endif style="background-color:rgb(255, 255, 0); color:black">COMPLEMENTAR</option>
            <option value="2"  @if ($gepex->priority == 2) selected @endif style="background-color:rgb(200, 162, 200); color:black">NORMAL</option>
            <option value="3"  @if ($gepex->priority == 3) selected @endif style="background-color:rgb(0, 0, 255); color:rgb(255, 255, 255)">SETORIAL</option>
            <option value="4"  @if ($gepex->priority == 4) selected @endif style="background-color:rgb(255, 0, 0); color:black">PRIORITÁRIO</option>
            

                </select>
        </div>
        <div class="form-group col-md-3">
            <label >Aprovar GEPEX:</label>
           <select name="status" class="form-control">
                    <option ">Selecione</option>
                                    <option value="S">SIM </option>
                                    <option value="N">NÃO </option>



                                </select>
        </div>
         <div class="form-group col-md-3">
           <label >Enviar:</label>
                                <button class=" btn btn-primary form-control"> Enviar para Aprovação</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
    </div>


@stop
