<?php

function setPriority($value){
  
    if ($value==1){
        $data['value']="COMPLEMENTAR";
        $data['color']="bg-yellow";
    }
    if ($value == 2) {
        $data['value'] = "NORMAL";
        $data['color']="bg-purple";
    }
    if ($value == 3) {
        $data['value'] = "SETORIAL";
        $data['color']="bg-blue";
    }
    if ($value == 4) {
        $data['value'] = "PRIORITÁRIO";
        $data['color']="bg-red";
    }
    return (object) $data;
}