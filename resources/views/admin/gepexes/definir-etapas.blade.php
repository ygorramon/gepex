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
                    <div class="col-sm-12 ">
                        <form action="{{ route('gepex-defenir-etapas-post', $gepex->id) }}" method="post"
                            class="form-group">
                            {!! csrf_field() !!}
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                            rowspan="1" colspan="1"
                                            aria-label="city: activate to sort column ascending">
                                            #</th>
                                        <th width="50%" class="sorting" tabindex="0" aria-controls="example2"
                                            rowspan="1" colspan="1"
                                            aria-label="city: activate to sort column ascending">
                                            Etapa</th>
                                        <th width="40%" class="sorting" tabindex="0" aria-controls="example2"
                                            rowspan="1" colspan="1"
                                            aria-label="city: activate to sort column ascending">
                                            Previsão de Conclusão</th>

                                    </tr>
                                </thead>
                                <tbody>


                                    @forelse ($steps_todos as $step)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="step_id[]"
                                                    @forelse ($steps_selecionados as $step_selecionado) @if ($step->id == $step_selecionado->id)
                       checked="true" 
                       @endif
                       @empty @endforelse
                                                    value="{{ $step->id }}">
                                            </td>
                                            <td>
                                                <spam class="example" data-toggle="tooltip" data-placement="right"
                                                    title="{{ $step->description }}">{{ $step->name }}</spam>
                                            </td>
                                            <td><input name="prevision_date[]" value="{{ $step->prevision_date }}"
                                                    type="date" class="form-control"></td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            <button class=" btn btn-primary"> Enviar</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $('.example').tooltip()
        </script>
    @endsection

@stop
