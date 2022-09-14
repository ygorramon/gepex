@extends('adminlte::page')


@section('content_header')
    <div class="card">

        <div class="card-body">
            <div class="box">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Relatórios</li>

                </ol>
                <h3 class="title"> Relatórios das Secretarias </h3>
                <div class="row">
                    @forelse($secretaries as $secretary)
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $secretary->name }}</h3>
                                </div>

                                <div class="card-body">


                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">TOTAL DE GEPEX`S</span>
                                                    <span class="info-box-number">{{ count($secretary->gepexes) }}</span>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">GEPEX'S FINALIZADAS</span>
                                                    <span class="info-box-number">{{ count($secretary->gepexes->where('status','FINALIZADO')) }}</span>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-flag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">GEPEX'S EM EXECUÇÃO</span>
                                                    <span class="info-box-number">{{ count($secretary->gepexes->where('status','EM EXECUÇÃO')) }}</span>
                                                </div>

                                            </div>

                                        </div>



                                    </div>
                                </div>

                            </div>

                        </div>

                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        @section('js')


        @endsection

    @stop
