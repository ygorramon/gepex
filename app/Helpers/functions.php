<?php

use App\Models\Gepex;

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

    $data['value']="";
    $data['color'] = "";

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

function setStatus($value)
{
    $data['value']="";
    $data['color'] = "";

    if ($value == "LANÇADO") {
        $data['value'] = "LANÇADO";
        $data['color'] = "bg-yellow";
    }
    if ($value == "ENVIADO") {
        $data['value'] = "ENVIADO";
        $data['color'] = "bg-yellow";
    }
    if ($value == "APROVADO") {
        $data['value'] = "APROVADO";
        $data['color'] = "bg-blue";
    }
    if ($value == "DEVOLVIDO") {
        $data['value'] = "DEVOLVIDO";
        $data['color'] = "bg-orange";
    }
    if ($value == "EM EXECUÇÃO") {
        $data['value'] = "EM EXECUÇÃO";
        $data['color'] = "bg-yellow";
    }
    if ($value == "CANCELADO") {
        $data['value'] = "CANCELADO";
        $data['color'] = "bg-red";
    }
    if ($value == "FINALIZADO") {
        $data['value'] = "FINALIZADO";
        $data['color'] = "bg-green";
    }

    return (object) $data;
}



function setDate($value){
    return Carbon\Carbon::parse($value)->format('d/m/Y');
    
}

function percent(Gepex $gepex){
    $value=0;
    $value= (count($gepex->steps->where('pivot.finished', '=', 1)) / count($gepex->steps))*100;
return $value;
}