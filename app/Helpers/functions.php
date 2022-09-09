<?php

function setPriority($value){
  
    if ($value==1){
        $data['value']="SETORIAL";
        $data['color']="bg-blue";
    }
    if ($value == 2) {
        $data['value'] = "PRIORITÁRIO";
        $data['color']="bg-red";
    }
    
    return (object) $data;
}

function setFinished($value)
{

    if ($value == 0) {
        $data['value'] = "INCOMPLETA";
        $data['color'] = "bg-red";
    }
    if ($value == 1) {
        $data['value'] = "COMPLETA";
        $data['color'] = "bg-green";
    }
    if ($value == 2) {
        $data['value'] = "EM EXECUÇÃO";
        $data['color'] = "bg-yellow";
    }
   
    return (object) $data;
}

function setDate($value){
    return Carbon\Carbon::parse($value)->format('d/m/Y');
    
}