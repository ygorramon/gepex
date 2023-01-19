<!DOCTYPE html>
  <html>
    <head>
      
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    .form-control {
  
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
   border: 2px solid red;
  border-radius: 4px;

}
  </style>
    
    </head>

    <body>
<center><img src="vendor/adminlte/dist/img/logo.png" width="150"></center>
      <h4>Relatório de Etapas de GEPEX </h4>   
     @forelse($gepex_steps as $gepex_step)
     <label>ID GEPEX: </label><input type="text" class="form-control" value="{{$gepex_step->gepex->uid}}">
     <br>
     <label>Descrição: </label><input type="text" class="form-control" value="{{$gepex_step->gepex->needs}}">
     <br>
     <label>Prioridade: </label><input type="text" class="form-control" value="{{ setPriority($gepex_step->gepex->priority)->value }}">
     <br>
     <label>ETAPA: </label><input type="text" class="form-control" value="{{ $gepex_step->step->name }}">
     <br>
     <label>STATUS: </label><input type="text" class="form-control" value="{{ setfinished($gepex_step->finished)->value}}">
     <br>
     <label>Previsao de Conclusão: </label><input type="text" class="form-control" value="{{ setDateConclusion($gepex_step->prevision_date)->value }}">
     <br>
<hr>
     @empty
     @endforelse 

</body>
  </html>

    
