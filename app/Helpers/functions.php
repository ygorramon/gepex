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
        $data['value'] = "LANÇADO";
        $data['color'] = "bg-yellow";
    }
    if ($value == 1) {
        $data['value'] = "APROVADO";
        $data['color'] = "bg-blue";
    }
    if ($value == 3) {
        $data['value'] = "DEVOLVIDO";
        $data['color'] = "bg-orange";
    }
    if ($value == 4) {
        $data['value'] = "EM EXECUÇÃO";
        $data['color'] = "bg-yellow";
    }
    if ($value == 5) {
        $data['value'] = "CANCELADO";
        $data['color'] = "bg-red";
    }
    if ($value == 6) {
        $data['value'] = "FINALIZADO";
        $data['color'] = "bg-green";
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