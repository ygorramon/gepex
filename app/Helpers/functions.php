<?php

function setPriority($value){
    $data="";
    if ($value==1){
        $data="COMPLEMENTAR";
    }
    if ($value == 2) {
        $data = "NORMAL";
    }
    if ($value == 2) {
        $data = "SETORIAL";
    }
    if ($value == 4) {
        $data = "PRIORITÁRIO";
    }
    return $data;
}