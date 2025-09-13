<?php

namespace App\Libraries;

class Alertas {

    public function alertaError($mensajeAlerta) {
        $texto = '';
        $texto .= "<script>";
        $texto .= "Swal.fire({";
        $texto .= "icon: 'error',";    
        $texto .= "title: '¡ERROR!',";
        $texto .= 'html: \''.$mensajeAlerta.'\'';
        $texto .= "})";
        $texto .= "</script>";
        return $texto;
    }

    public function alertaExito($mensajeAlerta) {
        $texto = '';
        $texto .= "<script>";
        $texto .= "Swal.fire({";
        $texto .= "icon: 'success',";    
        $texto .= "title: '¡ÉXITO!',";
        $texto .= 'html: \''.$mensajeAlerta.'\'';
        $texto .= "})";
        $texto .= "</script>";
        return $texto;
    }

    public function reDireccion($vinculoUrl, $tiempo = ''){
        $texto = '<script>';
        if($tiempo != ''){
            $obtienePeriodo = $tiempo * 1000;
            $texto .= 'setTimeout( function(){ location.href="'.$vinculoUrl.'"; }, '.$obtienePeriodo.' );';
        } else{
            $texto .= 'location.href="'.$vinculoUrl.'"';
        }
        $texto .= '</script>';
        return $texto;
    }

    public function reDireccionBlank($vinculoUrl, $tiempo = ''){
        $texto = '<script>';
        if($tiempo != ''){
            $obtienePeriodo = $tiempo * 1000;
            $texto .= 'setTimeout( function(){ location.href="'.$vinculoUrl.'"; }, '.$obtienePeriodo.' );';
        } else{
            $texto .= 'window.open("'.$vinculoUrl.'","_blank");';
        }
        $texto .= '</script>';
        return $texto;
    }    
    
    public function refrescar($tiempo = ''){
        $texto = '<script>';
        if($tiempo != ''){
            $obtienePeriodo = $tiempo * 1000;
            $texto .= 'setTimeout( function(){ parent.location.reload(); }, '.$obtienePeriodo.' );';
        } else{
            $texto .= 'parent.location.reload()';
        }
        $texto .= '</script>';
        return $texto;
    }
    
    public function tiempoPeriodo($tiempo){
        $obtienePeriodo = $tiempo * 1000;
        $texto = '<script>';
        $texto .= 'setTimeout( function(){ }, '.$obtienePeriodo.' );';
        $texto .= '</script>';
        return $texto;
        
    }
    
    public function alerta($mensajeAlerta){
        $texto = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $texto .= '<script>';
        $texto .= 'alert("'.$mensajeAlerta.'")';
        $texto .= '</script>';
        return $texto;
    }
    
    public function confirmar($mensajeAlerta, $opcion = array('yes' => '', 'no' => ''), $procesar = FALSE){
        $texto = '<meta charset="utf-8" />';
        $texto .= '<script>';
        $texto .= 'var choice = confirm("'.$mensajeAlerta.'"); ';
        $texto .= 'if(choice){ ';
        if($procesar === TRUE){
            $texto .= 'location.href="'.$opcion['yes'].'"; '; 
        }
        $texto .= '} else{ ';
        $texto .= 'location.href="'.$opcion['no'].'"; ';
        $texto .= '} ';
        $texto .= '</script>';
        return $texto;
    }
}
