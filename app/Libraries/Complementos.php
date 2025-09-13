<?php

namespace App\Libraries;

class Complementos {

    function _data_first_month_day() {
        $month = date('m');
        $year = date('Y');
        return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
    }    

    function _data_last_month_day() { 
        $month = date('m');
        $year = date('Y');
        $day = date("d", mktime(0,0,0, $month+1, 0, $year));
   
        return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
    }
    
    public function days_360($fecha1, $fecha2, $europeo = true) {
        //try switch dates: min to max
        if ($fecha1 > $fecha2) {
            $temf = $fecha1;
            $fecha1 = $fecha2;
            $fecha2 = $temf;
        }

        // get day month year...
        list($yy1, $mm1, $dd1) = explode('-', $fecha1);
        list($yy2, $mm2, $dd2) = explode('-', $fecha2);

        if ($dd1 == 31 || $dd1 == 28 || $dd1 == 29) {
            $dd1 = 30;
        }

        //checks according standars: 30E/360 or 30/360.
        if (!$europeo) {
            if (($dd1 == 30) and ( $dd2 == 31)) {
                $dd2 = 30;
            } else {
                if ($dd2 == 31) {
                    $dd2 = 30;
                }
            }
        }

        //check for invalid date
        if (($dd1 < 1) or ( $dd2 < 1) or ( $dd1 > 30) or ( $dd2 > 31) or ( $mm1 < 1) or ( $mm2 < 1) or ( $mm1 > 12) or ( $mm2 > 12) or ( $yy1 > $yy2)) {
            return(-1);
        }
        if (($yy1 == $yy2) and ( $mm1 > $mm2)) {
            return(-1);
        }
        if (($yy1 == $yy2) and ( $mm1 == $mm2) and ( $dd1 > $dd2)) {
            return(-1);
        }

        //Calc
        $yy = $yy2 - $yy1;
        $mm = $mm2 - $mm1;
        $dd = $dd2 - $dd1;

        return( ($yy * 360) + ($mm * 30) + $dd);
    }    
    
    public function calcularExperiencia($fechaInicio,$fechaFin){
        $firstDate  = new DateTime($fechaInicio);
        $secondDate = new DateTime($fechaFin);
        $intvl = $firstDate->diff($secondDate);
        $texto = $intvl->y ." año(s) - ".$intvl->m." mes(es) - ".$intvl->d." día(s)";        
        return $texto;
    }
    
    public function interpretarExperiencia($experienciaAcumulada){
        //var_dump($experienciaAcumulada);
        $anos = array();
        $meses = array();
        $dias = array();
        
        for($i=0;$i<count($experienciaAcumulada);$i++){
            $datosExperiencia = explode(" - ",$experienciaAcumulada[$i]);
            array_push($anos,$datosExperiencia[0]);
            array_push($meses,$datosExperiencia[1]);
            array_push($dias,$datosExperiencia[2]);
        }
        
        /* SUMAR DIAS */
        $diasExperiencia = 0;
        for($i=0;$i<count($dias);$i++){
            $arrayDias = explode(" ",$dias[$i]);
            $diasExperiencia += $arrayDias[0];
        } 
        
        /* SUMAR MESES */
        $mesesExperiencia = 0;
        for($i=0;$i<count($meses);$i++){
            $arrayMeses = explode(" ",$meses[$i]);
            $mesesExperiencia += $arrayMeses[0];
        }    
        
        /* SUMAR AÑOS */
        $anosExperiencia = 0;
        for($i=0;$i<count($anos);$i++){
            $arrayAnos = explode(" ",$anos[$i]);
            $anosExperiencia += $arrayAnos[0];
        }            
        
        /* VALIDAR EXCESO DE DIAS */
        $saldoDias = $diasExperiencia % 30;
        $nuevosMeses = floor($diasExperiencia / 30);
        
        /* VALIDAR EXCESO DE MESES */
        $mesesExperiencia = $mesesExperiencia + $nuevosMeses;
        $saldoMeses = $mesesExperiencia % 12;
        $nuevosAnos = floor($mesesExperiencia / 12);
        
        /* VALIDAR EXCESO DE MESES */
        $anosExperiencia = $anosExperiencia + $nuevosAnos;
        
        $texto = $anosExperiencia ." año(s) - ".$saldoMeses." mes(es) - ".$saldoDias." día(s)";        
        //var_dump($texto);exit;
        return $texto;
    }    

    public function validarFecha($date, $format = 'Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function curl($url = '', $attributes = array()) {
        if ($url == '')
            return FALSE;
        if (!function_exists('curl_init')) {
            die('Sorry cURL is not installed!');
            return FALSE;
        }
        if (is_array($attributes) && count($attributes) > 0) {
            $parameters = '';
            foreach ($attributes as $key => $value) {
                $value = str_replace(' ', '%20', $value);
                if ($parameters == '') {
                    $parameters .= '?' . $key . '=' . $value . '';
                } else {
                    $parameters .= '&' . $key . '=' . $value . '';
                }
            }
        } else {
            return FALSE;
        }
        $cookie = 'cookies.txt';
        $init = curl_init();
        curl_setopt($init, CURLOPT_URL, $url . $parameters);
        curl_setopt($init, CURLOPT_REFERER, $url . $parameters);
        curl_setopt($init, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($init, CURLOPT_HEADER, 0);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($init, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($init, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt($init, CURLOPT_COOKIESESSION, TRUE);
        curl_setopt($init, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($init);
        curl_close($init);
        return $output;
    }

    function generaNickUsuario($nombreCompleto) {
        if (!empty($nombreCompleto)) {
            $limitador = explode(' ', $nombreCompleto);
            $obtieneApellido = strtolower($limitador[count($limitador) - 1]);
            $inicialNombre = substr($nombreCompleto, 0, 1);
            $obtieneNick = strtolower($inicialNombre . $obtieneApellido);
            $generaNick = $obtieneNick . date('y') . $this->aleatorio(4, FALSE, FALSE, TRUE, FALSE);
            $generaNick = $this->generaTextoAmigable($generaNick, '-');
            return $generaNick;
        } else {
            return FALSE;
        }
    }

    public function cstr($arreglo, $tipo = FALSE) {
        if (!$tipo) {
            echo "<pre>";
            print_r($arreglo);
            echo "</pre>";
        } else {
            var_dump($arreglo);
        }
    }

    public function obtenerTiempo($fecha) {
        return strtotime($fecha);
    }

    public function obtenerFecha($tiempo, $tipoEstilo = '') {
        date_default_timezone_set('America/Lima');
        if (($tipoEstilo == 'date') || ($tipoEstilo == 'datetime') || ($tipoEstilo == '')) {
            $generaFecha = date('Y-m-d H:i:s a', $tiempo);
        } else {
            $generaFecha = date('Y-m-d h:i:s a', $tiempo);
        }
        $delimitador = explode(" ", $generaFecha);
        $obtieneFecha = explode("-", $delimitador[0]);
        $dia = $obtieneFecha[2];
        $mes = $obtieneFecha[1];
        $ano = $obtieneFecha[0];
        $obtieneHora = explode(":", $delimitador[1]);
        $segundo = $obtieneHora[2];
        $minuto = $obtieneHora[1];
        $hora = $obtieneHora[0];
        $meridiano = strtolower($delimitador[2]);
        if ($tipoEstilo == '') {
            return $generaFecha;
        } else {
            switch ($tipoEstilo) {
                case 1:
                    $resultado = $dia . ' de ' . $this->parseoMes($mes);
                    break;
                case 2:
                    $resultado = $dia . ' de ' . $this->parseoMes($mes) . ' del ' . $ano;
                    break;
                case 3:
                    $resultado = $this->parseoMes($mes) . ' ' . $dia . ', ' . $ano;
                    break;
                case 4:
                    $resultado = $dia . ' ' . $this->parseoMes($mes) . ' ' . $hora . ':' . $minuto . ' ' . $meridiano;
                    break;
                case 5:
                    $resultado = $dia . ' de ' . $this->parseoMes($mes) . ' a las ' . $hora . ':' . $minuto . ' ' . $meridiano;
                    break;
                case 6:
                    $resultado = $dia . ' ' . $this->parseoMes($mes, TRUE) . ' ' . $ano;
                    break;
                case 7:
                    $resultado = $dia . ' de ' . $this->parseoMes($mes) . ' del ' . $ano . ' a las ' . $hora . ':' . $minuto . ' ' . $meridiano;
                    break;
                case 8:
                    $resultado = $this->parseoMes($mes, TRUE) . ' ' . $dia . ', ' . $ano;
                    break;
                case 'date':
                    $resultado = $dia . '-' . $mes . '-' . $ano;
                    break;
                case 'datetime':
                    $resultado = $dia . '-' . $mes . '-' . $ano . ' ' . $hora . ':' . $minuto . ':' . $segundo;
                    break;
                case 15:
                    $resultado = $dia . '-' . $mes . '-' . $ano;
                    break;
                case 16:
                    $resultado = $hora . ':' . $minuto . ':' . $meridiano;
                    break;
                case 17:
                    $resultado = $hora;
                    break;
                case 18:
                    $resultado = $minuto;
                    break;
                case 20:
                    $resultado = $ano;
                    break;
                case 21:
                    $resultado = $dia;
                    break;
                case 22:
                    $resultado = $ano . '-' . $mes . '-' . $dia . ' ' . $hora . ':' . $minuto . ':' . $segundo;
                    break;
                case 23:
                    $resultado = $mes;
                    break;
                case 24:
                    $resultado = $ano . '-' . $mes . '-' . $dia;
                    break;
                case 25:
                    $resultado = $hora . ':' . $minuto . ':' . $segundo . $meridiano;
                    break;
                default:
                    return $generaFecha;
            }
            return $resultado;
        }
    }

    public function cantidadDiasPorMes($mes, $ano = '') {
        switch ($mes) {
            case 1:case 01: $dias = 31;
                break;
            case 2:case 02:
                if ($ano != '') {
                    $obtieneAno = $ano;
                } else {
                    $obtieneAno = date('Y');
                }
                $dias = (($obtieneAno % 4 == 0 && $obtieneAno % 100 != 0) || $obtieneAno % 400 == 0) ? 29 : 28;
                break;
            case 3:case 03: $dias = 31;
                break;
            case 4:case 04: $dias = 30;
                break;
            case 5:case 05: $dias = 31;
                break;
            case 6:case 06: $dias = 30;
                break;
            case 7:case 07: $dias = 31;
                break;
            //case 8:case 08: $dias = 31;
                //break;
            case 9: $dias = 30;
                break;
            case 10: $dias = 31;
                break;
            case 11: $dias = 30;
                break;
            case 12: $dias = 31;
                break;
            default : $dias = 31;
                break;
        }
        return $dias;
    }

    public function parseoDia($dia, $minificado = FALSE) {
        switch ($dia) {
            case 1: case 01: return (!$minificado) ? "Lunes" : "Lun";
            case 2: case 02: return (!$minificado) ? "Martes" : "Mar";
            case 3: case 03: return (!$minificado) ? "Miércoles" : "Mie";
            case 4: case 04: return (!$minificado) ? "Jueves" : "Jue";
            case 5: case 05: return (!$minificado) ? "Viernes" : "Vie";
            case 6: case 06: return (!$minificado) ? "Sábado" : "Sab";
            case 7: case 07: return (!$minificado) ? "Domingo" : "Dom";
        }
    }

    public function parseoMes($mes, $minificado = FALSE) {
        switch ($mes) {
            case 1: case 01: return (!$minificado) ? "Enero" : "Ene";
            case 2: case 02: return (!$minificado) ? "Febrero" : "Feb";
            case 3: case 03: return (!$minificado) ? "Marzo" : "Mar";
            case 4: case 04: return (!$minificado) ? "Abril" : "Abr";
            case 5: case 05: return (!$minificado) ? "Mayo" : "May";
            case 6: case 06: return (!$minificado) ? "Junio" : "Jun";
            case 7: case 07: return (!$minificado) ? "Julio" : "Jul";
            case 8: return (!$minificado) ? "Agosto" : "Ago";
            case 9: return (!$minificado) ? "Septiembre" : "Sep";
            case 10: return (!$minificado) ? "Octubre" : "Oct";
            case 11: return (!$minificado) ? "Noviembre" : "Nov";
            case 12: return (!$minificado) ? "Diciembre" : "Dic";
        }
    }

    public function verificarExtensionArchivo($nombreArchivo, $extension = 'jpeg|jpg|png|gif') {
        $delimitarNombre = strtolower($nombreArchivo);
        $delimitarTipos = explode('|', $extension);
        $datosTmp = array();
        foreach ($delimitarTipos as $items) {
            $datosTmp[] = trim($items);
        }
        $listaBlanca = $datosTmp;
        $listaNegra = array('php', 'php3', 'php4', 'phtml', 'exe');
        $delimitarExtension = explode('.', $delimitarNombre);
        $obtieneExtension = strtolower(end($delimitarExtension));
        if (!in_array($obtieneExtension, $listaBlanca)) {
            return FALSE;
        } elseif (in_array($obtieneExtension, $listaNegra)) {
            return FALSE;
        }
        return TRUE;
    }

    public function aleatorio($longitud = 40, $minuscula = TRUE, $mayuscula = FALSE, $numero = TRUE, $caracterEspecial = FALSE) {
        $source = '';
        if ($minuscula === TRUE) {
            $source .= 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($mayuscula === TRUE) {
            $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($numero === TRUE) {
            $source .= '1234567890';
        }
        if ($caracterEspecial === TRUE) {
            $source .= '|@#~$%()=^*+[]{}-_';
        }
        if ($longitud > 0) {
            $resultado = '';
            $source = str_split($source, 1);
            for ($i = 1; $i <= $longitud; $i++) {
                mt_srand((double) microtime() * 1000000);
                $obtieneNumero = mt_rand(1, count($source));
                $resultado .= $source[$obtieneNumero - 1];
            }
        }
        return $resultado;
    }

    /*
     * $opciones = array(
     *      'marcaTipo' => FALSE,
     *      'marcaInfo' => FALSE,
     *      'ajuste' => 'w',
     *      'ajusteImagen' => 1900,
     *      'desenfocado' => FALSE,
     *      'nombreEmpresa' => 'SISTEMA',
     *      'cantidadCopia' => array()
     * );
     * $this->complementos->almacenarImagen($imagen, 'public/imagen/modulo', $opciones, FALSE);
     */

    public function almacenarImagen($imagen, $ubicacionCarpeta, $opciones, $nuevoNombre = FALSE) {
        $opDefecto = array(
            'marcaTipo' => FALSE, // 'texto', 'imagen', FALSE
            'marcaInfo' => FALSE, // ([texto] => 'palabra de texto'), ([imagen] => 'ruta de la imagen')
            'ajuste' => 'w', // 'w', 'h', 'auto', 'noauto'
            'ajusteImagen' => 1900, // ['w', 'h'] => 1366, ['auto', 'noauto'] => '1366*768'
            'desenfocado' => FALSE, // 0-100, FALSE
            'nombreEmpresa' => 'SISTEMA', // [texto] => 'Nombre de la empresa'
            'cantidadCopia' => array(), // [numero] => 'Arreglo de elementos con respecto a su cantidad'
            'base64' => FALSE // TRUE, FALSE
        );
        $opGenerada = array_merge($opDefecto, $opciones);
        if ($opGenerada['base64']) {
            $tempImagen = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagen));
            if ($nuevoNombre !== FALSE) {
                $delimitar = explode('.', 'temp.png');
                $extension = strtolower(end($delimitar));
                $transformaArchivo = $this->generaTextoAmigable($delimitar[0], '_');
                $transformaProyecto = $this->generaTextoAmigable($opGenerada['nombreEmpresa'], '_');
                $obtieneArchivo = $opGenerada['cantidadCopia'];
                $generaNombre = '';
                if (!empty($obtieneArchivo)) {
                    $generaNombre = $transformaProyecto . '_' . $transformaArchivo . '_' . $this->aleatorio(20, FALSE, FALSE, TRUE, FALSE) . '_copia' . count($obtieneArchivo) . '_';
                } else {
                    $generaNombre = $transformaProyecto . '_' . $transformaArchivo . '_' . $this->aleatorio(20, FALSE, FALSE, TRUE, FALSE) . '_';
                }
                $resultado = $generaNombre . '.' . $extension;
            } else {
                $delimitar = explode('.', 'temp.png');
                $extension = strtolower(end($delimitar));
                $resultado = $this->aleatorio() . '.' . $extension;
            }
            file_put_contents('./' . $ubicacionCarpeta . '/' . $resultado, $tempImagen);
            return $resultado;
        }
        $this->ci->image->ready($imagen['tmp_name'], TRUE);
        switch ($opGenerada['ajuste']) {
            case 'w':
                $ancho = (is_int($opGenerada['ajusteImagen'])) ? $opGenerada['ajusteImagen'] : 1920;
                $this->ci->image->resizeToWidth($ancho);
                break;
            case 'h':
                $alto = (is_int($opGenerada['ajusteImagen'])) ? $opGenerada['ajusteImagen'] : 1200;
                $this->ci->image->resizeToHeight($alto);
                break;
            case 'auto':
                $ajuste = (strpos($opGenerada['ajusteImagen'], '*') !== FALSE) ? $opGenerada['ajusteImagen'] : '1920*1200';
                $delimitador = explode('*', trim($ajuste));
                $this->ci->image->resizeToFit($delimitador[0], $delimitador[1], TRUE, 'FFFFFF');
                break;
            case 'noauto':
                $ajuste = (strpos($opGenerada['ajusteImagen'], '*') !== FALSE) ? $opGenerada['ajusteImagen'] : '1920*1200';
                $delimitador = explode('*', trim($ajuste));
                $this->ci->image->resize($delimitador[0], $delimitador[1]);
                break;
            default:
                $ancho = (is_int($opGenerada['ajusteImagen'])) ? $opGenerada['ajusteImagen'] : 1920;
                $this->ci->image->resizeToWidth($ancho);
                break;
        }
        if ($opGenerada['marcaTipo'] !== FALSE && $opGenerada['marcaInfo'] !== FALSE) {
            switch ($opGenerada['marcaTipo']) {
                case 'texto':
                    $this->ci->image->stringWatermark($opGenerada['marcaInfo'], 70, 'FFFFFF', 'top right', 10, 10);
                    break;
                case 'imagen':
                    $this->ci->image->imgWatermark($opGenerada['marcaInfo'], 70, 'top right', 10, 10);
                    break;
            }
        }
        if ($opGenerada['desenfocado'] !== FALSE) {
            $desenfocado = (int) $opGenerada['desenfocado'];
            $desenfocado = ($desenfocado <= 0) ? 0 : $desenfocado;
            $this->ci->image->onFocused($desenfocado);
        }
        if ($nuevoNombre !== FALSE) {
            $delimitar = explode('.', $imagen['name']);
            $extension = strtolower(end($delimitar));
            $transformaArchivo = $this->generaTextoAmigable($delimitar[0], '_');
            $transformaProyecto = $this->generaTextoAmigable($opGenerada['nombreEmpresa'], '_');
            $obtieneArchivo = $opGenerada['cantidadCopia'];
            $generaNombre = '';
            if (!empty($obtieneArchivo)) {
                $generaNombre = $transformaProyecto . '_' . $transformaArchivo . '_' . $this->aleatorio(20, FALSE, FALSE, TRUE, FALSE) . '_copia' . count($obtieneArchivo) . '_';
            } else {
                $generaNombre = $transformaProyecto . '_' . $transformaArchivo . '_' . $this->aleatorio(20, FALSE, FALSE, TRUE, FALSE) . '_';
            }
            $resultado = $generaNombre . '.' . $extension;
        } else {
            $delimitar = explode('.', $imagen['name']);
            $extension = strtolower(end($delimitar));
            $resultado = $this->aleatorio() . '.' . $extension;
        }
        $this->ci->image->save('./' . $ubicacionCarpeta . '/' . $resultado, 100);
        return $resultado;
    }

    /*
     * $opciones = array(
     *      'nombreEmpresa' => 'SISTEMA',
     *      'cantidadCopia' => array()
     * );
     * $this->complementos->almacenarArchivo($archivo, 'public/imagen/modulo', $opciones, FALSE);
     */ 
    
    public function almacenarArchivo($archivo, $ubicacionCarpeta, $opciones, $nuevoNombre = FALSE) {
        $opDefecto = array(
            'nombreEmpresa' => 'SISTEMA', // [texto] => 'Nombre de la empresa'
            'cantidadCopia' => array() // [numero] => 'Arreglo de elementos con respecto a su cantidad'
        );
        $opGenerada = array_merge($opDefecto, $opciones);
        if ($nuevoNombre !== FALSE) {
            $delimitar = explode('.', $archivo['name']);
            $extension = strtolower(end($delimitar));
            $transformaArchivo = $this->generaTextoAmigable($delimitar[0], '_');
            $transformaProyecto = $this->generaTextoAmigable($opGenerada['nombreEmpresa'], '_');
            $obtieneArchivo = $opGenerada['cantidadCopia'];
            $generaNombre = '';
            if (!empty($obtieneArchivo)) {
                $generaNombre = $transformaProyecto . '_' . $transformaArchivo . '_' . $this->aleatorio(20, FALSE, FALSE, TRUE, FALSE) . '_copia' . count($obtieneArchivo) . '_';
            } else {
                $generaNombre = $transformaProyecto . '_' . $transformaArchivo . '_' . $this->aleatorio(20, FALSE, FALSE, TRUE, FALSE) . '_';
            }
            $resultado = $generaNombre . '.' . $extension;
        } else {
            $delimitar = explode('.', $archivo['name']);
            $extension = strtolower(end($delimitar));
            $resultado = $this->aleatorio() . '.' . $extension;
        }
        move_uploaded_file($archivo['tmp_name'], $ubicacionCarpeta . '/' . $resultado);
        return $resultado;
    }

    public function almacenarArchivoAltas($archivo, $codigoDoc, $numDocumento, $ubicacionCarpeta, $opciones, $nuevoNombre = FALSE) {
        $opDefecto = array(
            'nombreEmpresa' => 'SISTEMA', // [texto] => 'Nombre de la empresa'
            'cantidadCopia' => array() // [numero] => 'Arreglo de elementos con respecto a su cantidad'
        );

        $opGenerada = array_merge($opDefecto, $opciones);
        if ($nuevoNombre !== FALSE) {            
            $delimitar = explode('.', $archivo['name']);
            $extension = strtolower(end($delimitar));
            $transformaArchivo = $codigoDoc . "-" . $numDocumento;
            $resultado = $transformaArchivo . '.' . $extension;
        } else {
            $delimitar = explode('.', $archivo['name']);
            $extension = strtolower(end($delimitar));
            $resultado = $this->aleatorio() . '.' . $extension;
        }
        move_uploaded_file($archivo['tmp_name'], $ubicacionCarpeta . '/' . $resultado);
        return $resultado;
    }

    public function guardarArchivo($archivo, $ubicacionCarpeta, $espacioMaximo = 5, $nuevoNombre = FALSE) {
        $mensajeAlerta = array();
        $archivoNombre = $archivo['name'];
        $archivoPeso = $archivo['size'];
        $tmpArchivoNombre = $archivo['tmp_name'];
        if (!$nuevoNombre) {
            $generaNombreArchivo = $this->aleatorio();
        } else {
            $generaNombreArchivo = $nuevoNombre;
        }
        $this->ci->file->loadFile($archivoNombre, $ubicacionCarpeta, $archivoPeso, $tmpArchivoNombre, $generaNombreArchivo, $espacioMaximo);
        $resultado = $this->ci->file->uploadFile();
        if ($resultado['archivo'] !== FALSE) {
            $mensajeAlerta = array(
                'mensaje' => $resultado['mensaje'],
                'archivo' => $resultado['archivo']
            );
        } else {
            $mensajeAlerta = array(
                'mensaje' => $resultado['mensaje'],
                'archivo' => FALSE
            );
        }
        return $mensajeAlerta;
    }

    public function obtenerArchivo($archivo, $tipoSubida = 'unico', $extension = 'pdf|docx|jpg|jpeg|png|gif|ppt|pptx|xls|xlsx|txt') {
        switch ($tipoSubida) {
            case 'unico':
                if (isset($_FILES[$archivo]['tmp_name']) && $_FILES[$archivo]['tmp_name'] != '') {
                    $obtieneArchivo = $_FILES[$archivo];
                    $resultado = $this->verificarExtensionArchivo($obtieneArchivo['name'], $extension);
                    if (!$resultado) {
                        return FALSE;
                    } else {
                        return $obtieneArchivo;
                    }
                } else {
                    return FALSE;
                }
                break;
            case 'muchos':
                if (isset($_FILES[$archivo]['tmp_name'][0]) && $_FILES[$archivo]['tmp_name'][0] != '') {
                    $obtieneArchivo = $_FILES[$archivo];
                    for ($i = 0; $i < count($obtieneArchivo['tmp_name']); $i++) {
                        $resultado = $this->verificarExtensionArchivo($obtieneArchivo['name'][$i], $extension);
                        if (!$resultado) {
                            continue;
                        } else {
                            $datosArchivo[] = array(
                                'name' => $obtieneArchivo['name'][$i],
                                'type' => $obtieneArchivo['type'][$i],
                                'tmp_name' => $obtieneArchivo['tmp_name'][$i],
                                'error' => $obtieneArchivo['error'][$i],
                                'size' => $obtieneArchivo['size'][$i]
                            );
                        }
                    }
                    if (isset($datosArchivo)) {
                        return $datosArchivo;
                    }
                    return FALSE;
                } else {
                    return FALSE;
                }
                break;
            case 'muchosAlt':
                $obtieneArchivo = $_FILES[$archivo];
                for ($i = 0; $i < count($obtieneArchivo['tmp_name']); $i++) {
                    $resultado = $this->verificarExtensionArchivo($obtieneArchivo['name'][$i], $extension);
                    if (!$resultado) {
                        continue;
                    } else {
                        $datosArchivo[] = array(
                            'name' => $obtieneArchivo['name'][$i],
                            'type' => $obtieneArchivo['type'][$i],
                            'tmp_name' => $obtieneArchivo['tmp_name'][$i],
                            'error' => $obtieneArchivo['error'][$i],
                            'size' => $obtieneArchivo['size'][$i]
                        );
                    }
                }
                if (isset($datosArchivo)) {
                    return $datosArchivo;
                }
                break;
            default:
                return FALSE;
        }
    }

    public function eliminarArchivo($nombreArchivo, $ubicacionCarpeta) {
        if (!file_exists('./' . $ubicacionCarpeta . '/' . $nombreArchivo)) {
            return FALSE;
        } else {
            @unlink('./' . $ubicacionCarpeta . '/' . $nombreArchivo);
            return TRUE;
        }
    }

    public function eliminarCarpeta($ubicacion) {
        foreach (glob($ubicacion . "/*") as $archivos) {
            if (is_dir($archivos)) {
                $this->eliminarCarpeta($archivos);
            } else {
                unlink($archivos);
            }
        }
        return rmdir($ubicacion);
    }

    public function hexaPorRgb($hexa) {
        $hexa = str_replace("#", "", $hexa);
        if (strlen($hexa) == 3) {
            $r = hexdec(substr($hexa, 0, 1) . substr($hexa, 0, 1));
            $g = hexdec(substr($hexa, 1, 1) . substr($hexa, 1, 1));
            $b = hexdec(substr($hexa, 2, 1) . substr($hexa, 2, 1));
        } else {
            $r = hexdec(substr($hexa, 0, 2));
            $g = hexdec(substr($hexa, 2, 2));
            $b = hexdec(substr($hexa, 4, 2));
        }
        $generaRGB = array($r, $g, $b);
        return $generaRGB;
    }

    public function validaCampo($post, $parametros, $etiqueta) {
        $delimita = explode('|', trim(trim($parametros, '|')));
        //var_dump($delimita);
        $mensaje = '';
        foreach ($delimita as $items) {
            $valor = trim($items);
            $transValor = '';
            if (strpos($valor, 'minnumber') !== FALSE) {
                $temp = str_replace('minnumber', '', $valor);
                $temp = str_replace('[', '', $temp);
                $temp = str_replace(']', '', $temp);
                $transValor = (int) $temp;
            }
            if (strpos($valor, 'maxnumber') !== FALSE) {
                $temp = str_replace('maxnumber', '', $valor);
                $temp = str_replace('[', '', $temp);
                $temp = str_replace(']', '', $temp);
                $transValor = (int) $temp;
            }
            if (strpos($valor, 'minlength') !== FALSE) {
                $temp = str_replace('minlength', '', $valor);
                $temp = str_replace('[', '', $temp);
                $temp = str_replace(']', '', $temp);
                $transValor = (int) $temp;
            }
            if (strpos($valor, 'maxlength') !== FALSE) {
                $temp = str_replace('maxlength', '', $valor);
                $temp = str_replace('[', '', $temp);
                $temp = str_replace(']', '', $temp);
                $transValor = (int) $temp;
            }
            if (strpos($valor, 'matched') !== FALSE) {
                $temp = str_replace('matched', '', $valor);
                $temp = str_replace('[', '', $temp);
                $temp = str_replace(']', '', $temp);
                $data = explode('%', $temp);
                $otraEtiqueta = (string) $data[0];
                $otroPost = (string) $data[1];
            }
            $transEtiqueta = '<small>' . $etiqueta . '</small>';
            if (($valor == 'trim') && ($post != trim($post))) {
                $mensaje .= '<li>No se permiten espacios en los extremos. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'required') && ($post == '')) {
                $mensaje .= '<li>Completar el campo <b>' . $transEtiqueta . '</b>.</li>';
            } else
            if (($valor == 'alpha') && ($post != '') && (!preg_match("/^([[:alpha:]])*$/", $post))) {
                $mensaje .= '<li>Se permiten unicamente carácteres alfabéticos. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'alphanumeric') && ($post != '') && (!preg_match("/^([\.[:alnum:]])*$/", $post))) {
                $mensaje .= '<li>Se permiten unicamente carácteres alfanuméricos.[CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'numeric') && ($post != '') && (!preg_match("/^([[:digit:]])*$/", $post))) {
                $mensaje .= '<li>Se permiten unicamente carácteres numéricios. [CAMPO]. ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'alphaspace') && ($post != '') && (!ctype_alpha(str_replace(' ', '', $post)))) {
                $mensaje .= '<li>Se permiten únicamente carácteres alfabéticos y espacios. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'decimal') && ($post != '') && (!preg_match("/^[0-9]+(\.[0-9]+)?$/", $post))) {
                $mensaje .= '<li>Se permiten únicamente números enteros y decimales. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'date') && ($post != '') && (!preg_match('/^(\d\d\-\d\d\-\d\d\d\d){1,1}$/', $post))) {
                $mensaje .= '<li>Se permiten únicamente fechas con formato dd-mm-yyyy. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'dateDos') && ($post != '') && (!preg_match('/^(\d\d\d\d\-\d\d\-\d\d){1,1}$/', $post))) {
                $mensaje .= '<li>Se permiten únicamente fechas con formato yyyy-mm-dd. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'alphaspecial') && ($post != '') && (!preg_match('/^[a-zñÑáéíóú\d_\s\/]+$/i', $post))) {
                $mensaje .= '<li>Se permiten únicamente carácteres alfabéticos especiales. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'name') && ($post != '') && (!preg_match('/^[a-zA-ZÀ-ÿ ]*$/', $post))) {
                $mensaje .= '<li>Se permiten únicamente carácteres alfabéticos y tildes. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'desplegables') && ($post != '') && (!ctype_alpha(str_replace(' ', '', $post)))) {
                $mensaje .= '<li>Se permiten únicamente carácteres alfabéticos y tildes. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'url') && ($post != '') && (!preg_match('/^[http:\/\/|www.|https:\/\/]/i', $post))) {
                $mensaje .= '<li>Se permiten únicamente direcciones con formato URL. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'ftp') && ($post != '') && (!preg_match('/^[ftp.]/i', $post))) {
                $mensaje .= '<li>Se permiten únicamente direcciones con formato FTP. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if ((strpos($valor, 'minnumber') !== FALSE) && ($post != '') && ($post < $transValor)) {
                $mensaje .= '<li>El número ingresado es menor de ' . $transValor . '. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if ((strpos($valor, 'maxnumber') !== FALSE) && ($post != '') && ($post > $transValor)) {
                $mensaje .= '<li>El número ingresado es mayor de ' . $transValor . '. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if ((strpos($valor, 'minlength') !== FALSE) && ($post != '') && (mb_strlen($post) < $transValor)) {
                $mensaje .= '<li>El texto ingresado es menor a ' . $transValor . ' carácteres. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if ((strpos($valor, 'maxlength') !== FALSE) && ($post != '') && (mb_strlen($post) > $transValor)) {
                $mensaje .= '<li>El texto ingresado es mayor a ' . $transValor . ' carácteres. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if (($valor == 'email') && ($post != '') && (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $post))) {
                $mensaje .= '<li>Se permiten únicamente direcciones de correo electrónico. [CAMPO] ' . $transEtiqueta . '</li>';
            } else
            if ((strpos($valor, 'matched') !== FALSE) && ($post != '' || $otroPost != '') && ($post != $otroPost)) {
                $mensaje .= ''
                        . '<li>No se relacionan. '
                        . '[CAMPO] <small>' . $etiqueta . '</small>'
                        . ' y '
                        . '[CAMPO] <small>' . $otraEtiqueta . '</small>'
                        . '</li>';
            }
        }
        if ($mensaje != '') {
            return $mensaje;
        } else {
            return '';
        }
    }

    public function validaArchivo($post, $parametros, $etiqueta, $multiple = FALSE) {
        $transEtiqueta = '<small>' . $etiqueta . '</small>';
        $mensaje = '';
        if ($post !== FALSE) {
            $delimita = explode('|', trim(trim($parametros, '|')));
            if ($multiple) {
                for ($i = 0; $i < count($post); $i++) {
                    foreach ($delimita as $items) {
                        $valor = trim($items);
                        $transValor = '';
                        $this->ci->image->ready($post[$i]['tmp_name'], TRUE);
                        if (strpos($valor, 'maxsize') !== FALSE) {
                            $temp = str_replace('maxsize', '', $valor);
                            $temp = str_replace('[', '', $temp);
                            $temp = str_replace(']', '', $temp);
                            $transValor = (int) $temp;
                        }
                        if (strpos($valor, 'minsize') !== FALSE) {
                            $temp = str_replace('minsize', '', $valor);
                            $temp = str_replace('[', '', $temp);
                            $temp = str_replace(']', '', $temp);
                            $transValor = (int) $temp;
                        }

                        $number = round($post[$i]['size'] / 1048576, 2);
                        $getSize = (float) number_format($number, 2);

                        if ((strpos($valor, 'maxsize') !== FALSE) && $getSize > $transValor) {
                            $mensaje .= '<li>El archivo "' . $post[$i]['name'] . '" tiene un tamaño superior a ' . $transValor . ' MB. [CAMPO] ' . $transEtiqueta . '</li>';
                        } else
                        if ((strpos($valor, 'minsize') !== FALSE) && $getSize < $transValor) {
                            $mensaje .= '<li>El archivo "' . $post[$i]['name'] . '" tiene un tamaño inferior a ' . $transValor . ' MB. [CAMPO] ' . $transEtiqueta . '</li>';
                        }
                    }
                }
            } else
            if (!$multiple) {
                foreach ($delimita as $items) {
                    $valor = trim($items);
                    $transValor = '';
                    $this->ci->image->ready($post['tmp_name'], TRUE);
                    if (strpos($valor, 'maxsize') !== FALSE) {
                        $temp = str_replace('maxsize', '', $valor);
                        $temp = str_replace('[', '', $temp);
                        $temp = str_replace(']', '', $temp);
                        $transValor = (int) $temp;
                    }
                    if (strpos($valor, 'minsize') !== FALSE) {
                        $temp = str_replace('minsize', '', $valor);
                        $temp = str_replace('[', '', $temp);
                        $temp = str_replace(']', '', $temp);
                        $transValor = (int) $temp;
                    }

                    $number = round($post['size'] / 1048576, 2);
                    $getSize = (float) number_format($number, 2);

                    if ((strpos($valor, 'maxsize') !== FALSE) && $getSize > $transValor) {
                        $mensaje .= '<li>El archivo "' . $post['name'] . '" tiene un tamaño superior a ' . $transValor . ' MB. [CAMPO] ' . $transEtiqueta . '</li>';
                    } else
                    if ((strpos($valor, 'minsize') !== FALSE) && $getSize < $transValor) {
                        $mensaje .= '<li>El archivo "' . $post['name'] . '" tiene un tamaño inferior a ' . $transValor . ' MB. [CAMPO] ' . $transEtiqueta . '</li>';
                    }
                }
            }
        } else {
            $mensaje .= '<li>No existe ningún archivo(s) ingresado(s). [CAMPO] ' . $transEtiqueta . '</li>';
        }
        if ($mensaje != '') {
            return $mensaje;
        } else {
            return '';
        }
    }

    public function validaImagen($post, $parametros, $etiqueta, $multiple = FALSE) {
        $transEtiqueta = '<small>' . $etiqueta . '</small>';
        $mensaje = '';
        if ($post !== FALSE) {
            $delimita = explode('|', trim(trim($parametros, '|')));
            if ($multiple) {
                for ($i = 0; $i < count($post); $i++) {
                    foreach ($delimita as $items) {
                        $valor = trim($items);
                        $transValor = '';
                        $this->ci->image->ready($post[$i]['tmp_name'], TRUE);
                        if (strpos($valor, 'ratio') !== FALSE) {
                            $temp = str_replace('ratio', '', $valor);
                            $temp = str_replace('[', '', $temp);
                            $temp = str_replace(']', '', $temp);
                            $data = explode('*', $temp);
                            $ratioAncho = (int) $data[0];
                            $ratioAlto = (int) $data[1];
                            $ratio = $this->ratio($ratioAncho, $ratioAlto, $this->ci->image->getWidth());
                        }
                        if (strpos($valor, 'maxwidth') !== FALSE) {
                            $temp = str_replace('maxwidth', '', $valor);
                            $temp = str_replace('[', '', $temp);
                            $temp = str_replace(']', '', $temp);
                            $transValor = (int) $temp;
                        }
                        if (strpos($valor, 'maxheight') !== FALSE) {
                            $temp = str_replace('maxheight', '', $valor);
                            $temp = str_replace('[', '', $temp);
                            $temp = str_replace(']', '', $temp);
                            $transValor = (int) $temp;
                        }
                        if (strpos($valor, 'minwidth') !== FALSE) {
                            $temp = str_replace('minwidth', '', $valor);
                            $temp = str_replace('[', '', $temp);
                            $temp = str_replace(']', '', $temp);
                            $transValor = (int) $temp;
                        }
                        if (strpos($valor, 'minheight') !== FALSE) {
                            $temp = str_replace('minheight', '', $valor);
                            $temp = str_replace('[', '', $temp);
                            $temp = str_replace(']', '', $temp);
                            $transValor = (int) $temp;
                        }
                        if (strpos($valor, 'maxsize') !== FALSE) {
                            $temp = str_replace('maxsize', '', $valor);
                            $temp = str_replace('[', '', $temp);
                            $temp = str_replace(']', '', $temp);
                            $transValor = (int) $temp;
                        }
                        if (strpos($valor, 'minsize') !== FALSE) {
                            $temp = str_replace('minsize', '', $valor);
                            $temp = str_replace('[', '', $temp);
                            $temp = str_replace(']', '', $temp);
                            $transValor = (int) $temp;
                        }

                        $number = round($post[$i]['size'] / 1048576, 2);
                        $getSize = (float) number_format($number, 2);

                        if ((strpos($valor, 'maxwidth') !== FALSE) && $this->ci->image->getWidth() > $transValor) {
                            $mensaje .= '<li>La imágen "' . $post[$i]['name'] . '" tiene un ancho superior a ' . $transValor . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                        } else
                        if ((strpos($valor, 'maxheight') !== FALSE) && $this->ci->image->getHeight() > $transValor) {
                            $mensaje .= '<li>La imágen "' . $post[$i]['name'] . '" tiene un alto superior a ' . $transValor . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                        } else
                        if ((strpos($valor, 'maxsize') !== FALSE) && $getSize > $transValor) {
                            $mensaje .= '<li>La imágen "' . $post[$i]['name'] . '" tiene un tamaño superior a ' . $transValor . ' MB. [CAMPO] ' . $transEtiqueta . '</li>';
                        } else
                        if ((strpos($valor, 'minwidth') !== FALSE) && $this->ci->image->getWidth() < $transValor) {
                            $mensaje .= '<li>La imágen "' . $post[$i]['name'] . '" tiene un ancho inferior a ' . $transValor . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                        } else
                        if ((strpos($valor, 'minheight') !== FALSE) && $this->ci->image->getHeight() < $transValor) {
                            $mensaje .= '<li>La imágen "' . $post[$i]['name'] . '" tiene un alto inferior a ' . $transValor . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                        } else
                        if ((strpos($valor, 'minsize') !== FALSE) && $getSize < $transValor) {
                            $mensaje .= '<li>La imágen "' . $post[$i]['name'] . '" tiene un tamaño inferior a ' . $transValor . ' MB. [CAMPO] ' . $transEtiqueta . '</li>';
                        } else
                        if ((strpos($valor, 'ratio') !== FALSE) && $ratio['alto'] != $this->ci->image->getHeight()) {
                            $mensaje .= '<li>La imágen "' . $post[$i]['name'] . '" debe de tener una dimensión que encaje a ' . $ratioAncho . '*' . $ratioAlto . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                        }
                    }
                }
            } else
            if (!$multiple) {
                foreach ($delimita as $items) {
                    $valor = trim($items);
                    $transValor = '';
                    $this->ci->image->ready($post['tmp_name'], TRUE);
                    if (strpos($valor, 'ratio') !== FALSE) {
                        $temp = str_replace('ratio', '', $valor);
                        $temp = str_replace('[', '', $temp);
                        $temp = str_replace(']', '', $temp);
                        $data = explode('*', $temp);
                        $ratioAncho = (int) $data[0];
                        $ratioAlto = (int) $data[1];
                        $ratio = $this->ratio($ratioAncho, $ratioAlto, $this->ci->image->getWidth());
                    }
                    if (strpos($valor, 'maxwidth') !== FALSE) {
                        $temp = str_replace('maxwidth', '', $valor);
                        $temp = str_replace('[', '', $temp);
                        $temp = str_replace(']', '', $temp);
                        $transValor = (int) $temp;
                    }
                    if (strpos($valor, 'maxheight') !== FALSE) {
                        $temp = str_replace('maxheight', '', $valor);
                        $temp = str_replace('[', '', $temp);
                        $temp = str_replace(']', '', $temp);
                        $transValor = (int) $temp;
                    }
                    if (strpos($valor, 'minwidth') !== FALSE) {
                        $temp = str_replace('minwidth', '', $valor);
                        $temp = str_replace('[', '', $temp);
                        $temp = str_replace(']', '', $temp);
                        $transValor = (int) $temp;
                    }
                    if (strpos($valor, 'minheight') !== FALSE) {
                        $temp = str_replace('minheight', '', $valor);
                        $temp = str_replace('[', '', $temp);
                        $temp = str_replace(']', '', $temp);
                        $transValor = (int) $temp;
                    }
                    if (strpos($valor, 'maxsize') !== FALSE) {
                        $temp = str_replace('maxsize', '', $valor);
                        $temp = str_replace('[', '', $temp);
                        $temp = str_replace(']', '', $temp);
                        $transValor = (int) $temp;
                    }
                    if (strpos($valor, 'minsize') !== FALSE) {
                        $temp = str_replace('minsize', '', $valor);
                        $temp = str_replace('[', '', $temp);
                        $temp = str_replace(']', '', $temp);
                        $transValor = (int) $temp;
                    }

                    $number = round($post['size'] / 1048576, 2);
                    $getSize = (float) number_format($number, 2);

                    if ((strpos($valor, 'maxwidth') !== FALSE) && $this->ci->image->getWidth() > $transValor) {
                        $mensaje .= '<li>La imágen "' . $post['name'] . '" tiene un ancho superior a ' . $transValor . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                    } else
                    if ((strpos($valor, 'maxheight') !== FALSE) && $this->ci->image->getHeight() > $transValor) {
                        $mensaje .= '<li>La imágen "' . $post['name'] . '" tiene un alto superior a ' . $transValor . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                    } else
                    if ((strpos($valor, 'maxsize') !== FALSE) && $getSize > $transValor) {
                        $mensaje .= '<li>La imágen "' . $post['name'] . '" tiene un tamaño superior a ' . $transValor . ' MB. [CAMPO] ' . $transEtiqueta . '</li>';
                    } else
                    if ((strpos($valor, 'minwidth') !== FALSE) && $this->ci->image->getWidth() < $transValor) {
                        $mensaje .= '<li>La imágen "' . $post['name'] . '" tiene un ancho inferior a ' . $transValor . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                    } else
                    if ((strpos($valor, 'minheight') !== FALSE) && $this->ci->image->getHeight() < $transValor) {
                        $mensaje .= '<li>La imágen "' . $post['name'] . '" tiene un alto inferior a ' . $transValor . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                    } else
                    if ((strpos($valor, 'minsize') !== FALSE) && $getSize < $transValor) {
                        $mensaje .= '<li>La imágen "' . $post['name'] . '" tiene un tamaño inferior a ' . $transValor . ' MB. [CAMPO] ' . $transEtiqueta . '</li>';
                    } else
                    if ((strpos($valor, 'ratio') !== FALSE) && $ratio['alto'] != $this->ci->image->getHeight()) {
                        $mensaje .= '<li>La imágen "' . $post['name'] . '" debe de tener una dimensión que encaje a ' . $ratioAncho . '*' . $ratioAlto . ' px. [CAMPO] ' . $transEtiqueta . '</li>';
                    }
                }
            }
        } else {
            $mensaje .= '<li>No existe ninguna imágen(es) ingresada(s). [CAMPO] ' . $transEtiqueta . '</li>';
        }
        if ($mensaje != '') {
            return $mensaje;
        } else {
            return '';
        }
    }

    public function ratio($ratioAncho, $ratioAlto, $ancho) {
        $obtieneAncho = $ancho;
        $porcentAncho = (double) round((($ancho * 100) / $ratioAncho), 2);
        $obtieneAlto = (int) round((($ratioAlto * $porcentAncho) / 100));
        $data = array(
            'ancho' => $obtieneAncho,
            'alto' => $obtieneAlto
        );
        return $data;
    }

    public function generarCodigoQR($id, $type) {
        if ($id == '') {
            return '';
        } else {
            $params['data'] = $id;
            $params['level'] = 'H';
            $params['size'] = 5;
            $params['savename'] = './public/imagen/qrcode/qrcode_' . $type . '_' . $id . '.png';
            $this->ci->ciqrcode->generate($params);
            $p_qrcode = '<img src="' . base_url() . 'public/imagen/qrcode/qrcode_' . $type . '_' . $id . '.png" />';
            return $p_qrcode;
        }
    }

    public function generarCodigoBarra($id, $type) {
        if ($id == '') {
            return '';
        } else {
            $this->ci->barcode->barcode();
            $this->ci->barcode->setType('C128');
            $this->ci->barcode->setCode($id);
            $this->ci->barcode->setSize(80, 200);
            $file = './public/imagen/barcode/barcode_' . $id . '_' . $type . '.png';
            $this->ci->barcode->writeBarcodeFile($file);
            return '<img src="' . base_url() . 'public/imagen/barcode/barcode_' . $id . '_' . $type . '.png" />';
        }
    }

    public static function parseoUrl($string) {
        $url = strtolower($string);
        $b = array("á", "Á", "é", "É", "í", "Í", "ó", "Ó", "ú", "Ú", "ñ", "Ñ");
        $c = array("a", "a", "e", "e", "i", "i", "o", "o", "u", "u", "n", "n");
        $string = str_replace($b, $c, $url);
        $spacer = "-";
        $string = trim($string);
        $string = strtolower($string);
        $string = trim(@ereg_replace("[^ A-Za-z0-9_]", " ", $string));
        $string = @ereg_replace("[ \t\n\r]+", "-", $string);
        $string = str_replace(" ", $spacer, $string);
        $string = @ereg_replace("[ -]+", "-", $string);
        return $string;
    }

    public function ordenarPosicionArriba($datos, $element) {
        sort($datos);
        $data = array();
        foreach ($datos as $items) {
            $data[] = (int) $items;
        }
        $position = array_keys($data, $element);
        if (!empty($position)) {
            $tmp = array();
            $tmp_old = array();
            foreach ($data as $k => $v) {
                if ($k < ($position[0] - 1)) {
                    $tmp[] = (int) $v;
                } elseif ($k == $position[0]) {
                    $tmp[] = (int) $element;
                } else {
                    $tmp_old[] = $v;
                }
            }
            foreach ($tmp_old as $k => $v) {
                $tmp[] = (int) $v;
            }
            return $tmp;
        }
        return FALSE;
    }

    public function ordenarPosicionAbajo($datos, $element) {
        sort($datos);
        $data = array();
        foreach ($datos as $items) {
            $data[] = (int) $items;
        }
        $position = array_keys($data, $element);
        if (!empty($position)) {
            $tmp = array();
            $tmp_old = array();
            foreach ($data as $k => $v) {
                if ($k < $position[0]) {
                    $tmp[] = (int) $v;
                } elseif ($k == ($position[0] + 1)) {
                    $tmp[] = (int) $v;
                } else {
                    $tmp_old[] = $v;
                }
            }
            foreach ($tmp_old as $k => $v) {
                $tmp[] = (int) $v;
            }
            return $tmp;
        }
        return FALSE;
    }

    public function ordenarPosicion($datos, $posicionActual, $posicionNueva) {
        if ((array_key_exists($posicionNueva, $datos)) && ($posicionActual != $posicionNueva)) {
            $tmp = array();
            $tmp_1 = array();
            $tmp_2 = array();
            $tmp_3 = array();
            $i = $posicionNueva;
            foreach ($datos as $k => $v) {
                if ($k == $posicionNueva || $k == $posicionActual) {
                    continue;
                } else {
                    if ($posicionActual > $posicionNueva) {
                        if ($posicionNueva < $k) {
                            $tmp_1[$i] = $v;
                        } else {
                            $tmp[$k] = $v;
                        }
                    }
                    if ($posicionActual < $posicionNueva) {
                        if ($posicionNueva < $k) {
                            $tmp_1[$i] = $v;
                        } else {
                            $tmp[$k] = $v;
                        }
                    }
                }
                $i++;
            }
            if ($posicionActual > $posicionNueva) {
                $tmp[$posicionNueva] = $datos[$posicionActual];
                $tmp[$posicionNueva + 1] = $datos[$posicionNueva];
            }
            if ($posicionActual < $posicionNueva) {
                $tmp[$posicionNueva] = $datos[$posicionNueva];
                $tmp[$posicionNueva + 1] = $datos[$posicionActual];
            }
            $tmp_2 = array_merge($tmp, $tmp_1);
            foreach ($tmp_2 as $k => $v) {
                $tmp_3[$k + 1] = $v;
            }
            return $tmp_3;
        } else {
            return $datos;
        }
    }

    public function generaDesplegable($datos, $nombreImput, $valorDefecto = '', $texto = 'Seleccione una opción', $tipoSeleccion = 'none', $atributos = FALSE, $skin = 'selectpicker') {
        $this->ci = & get_instance();
        $this->ci->load->helper('form');
        $obtieneAtributos = ($atributos !== FALSE) ? $atributos : '';
        switch ($tipoSeleccion) {
            case 'search': $obtieneTipoSeleccion = 'data-live-search="true"';
                break;
            case 'none': $obtieneTipoSeleccion = '';
                break;
            default: $obtieneTipoSeleccion = '';
                break;
        }
        if ((!is_null($texto)) && ($texto !== FALSE)) {
            $opciones[''] = $texto;
        }
        foreach ($datos as $k => $v) {
            $opciones[$k] = $v;
        }
        switch ($skin) {
            case 'selectpicker': $infoExtra = 'id="' . $nombreImput . '" class="selectpicker" ' . $obtieneTipoSeleccion . ' ' . $obtieneAtributos;
                break;
            case 'simple': $infoExtra = 'id="' . $nombreImput . '" class="form-control select2" ' . $obtieneAtributos;
                break;
            default: $infoExtra = 'id="' . $nombreImput . '" class="form-control selectpicker" data-container="body" ' . $obtieneTipoSeleccion . ' ' . $obtieneAtributos;
                break;
        }
        $generaDesplegable = form_dropdown($nombreImput, $opciones, $valorDefecto, $infoExtra);
        unset($opciones);
        return $generaDesplegable;
    }

    public function generaTextoAmigable($nombre, $separador = '-') {
        $search = array(
            chr(192), chr(193), chr(194), chr(195), chr(224), chr(225), chr(226), chr(227), // a
            chr(201), chr(202), chr(233), chr(234), // e
            chr(205), chr(237), // i
            chr(211), chr(212), chr(213), chr(243), chr(244), chr(245), // o
            chr(218), chr(220), chr(250), chr(252), // u
            chr(199), chr(231), // c
            chr(209), chr(241) // ñ
        );
        $replace = array(
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
            'e', 'e', 'e', 'e',
            'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u',
            'c', 'c',
            'n', 'n'
        );
        $aux = strtolower(str_replace($search, $replace, $nombre));
        $aux = preg_replace('/[^a-z0-9]/', $separador, $aux);
        return $aux;
    }

    public function parseoVideoUrl($string, $type = 'url', $action = 'youtube', $data = array()) {
        $newResult = array();
        switch ($action) {
            case 'youtube':
                if (is_array($data) && count($data) > 0) {
                    $parameter = '?';
                    foreach ($data as $key => $val) {
                        $parameter .= $key . '=' . $val . '&';
                    }
                    $parameter = rtrim($parameter, '&');
                } else {
                    $parameter = '';
                }
                $result = preg_replace(
                        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "$2", $string
                );
                if ($type == 'url') {
                    $newResult = array(
                        'content' => 'http://www.youtube.com/embed/' . $result . $parameter,
                        'pic' => 'http://img.youtube.com/vi/' . $result . '/maxresdefault.jpg'
                    );
                } elseif ($type == 'iframe') {
                    $newResult = array(
                        'content' => '<iframe src="http://www.youtube.com/embed/' . $result . $parameter . '" allowfullscreen widht="100%" height="100%"></iframe>',
                        'pic' => 'http://img.youtube.com/vi/' . $result . '/maxresdefault.jpg'
                    );
                } else {
                    $newResult = array(
                        'content' => 'http://www.youtube.com/embed/' . $result . $parameter,
                        'pic' => 'http://img.youtube.com/vi/' . $result . '/maxresdefault.jpg'
                    );
                }
                return $newResult;
        }
    }

    public function calcularEdadPorAno($fechaNacimiento) {
        list($dia, $mes, $ano) = explode("-", $fechaNacimiento);
        $diferenciaAno = date("Y") - $ano;
        $diferenciaMes = date("m") - $mes;
        $diferenciaDia = date("d") - $dia;
        if ($diferenciaDia < 0 || $diferenciaMes < 0) {
            $diferenciaAno--;
        }
        return $diferenciaAno;
    }

    public function fechaAntiguedad($fechaInicio, $fechaFinal) {
        if (strtotime($fechaInicio, time()) > strtotime($fechaFinal, time())) {
            return 'Hace unos instantes';
        } else {
            $obtienFechaInicio = new DateTime($fechaInicio);
            $obtieneFechaFinal = new DateTime($fechaFinal);
            $diferenciaFecha = $obtienFechaInicio->diff($obtieneFechaFinal);
            switch (TRUE) {
                case ( ($diferenciaFecha->y == 0) && ($diferenciaFecha->m == 0) && ($diferenciaFecha->d == 0) && ($diferenciaFecha->h == 0) && ($diferenciaFecha->i == 0) && ($diferenciaFecha->s <= 5) ):
                    return 'Hace unos instantes';
                case ( ($diferenciaFecha->y == 0) && ($diferenciaFecha->m == 0) && ($diferenciaFecha->d == 0) && ($diferenciaFecha->h == 0) && ($diferenciaFecha->i == 0) && ($diferenciaFecha->s <= 59) ):
                    $valor = $diferenciaFecha->s;
                    $texto = ($valor <= 1) ? 'Hace ' . $diferenciaFecha->s . ' segundo' : 'Hace ' . $diferenciaFecha->s . ' segundos';
                    break;
                case ( ($diferenciaFecha->y == 0) && ($diferenciaFecha->m == 0) && ($diferenciaFecha->d == 0) && ($diferenciaFecha->h == 0) && ($diferenciaFecha->i <= 59) ):
                    $valor = $diferenciaFecha->i;
                    $texto = ($valor <= 1) ? 'Hace ' . $diferenciaFecha->i . ' minuto' : 'Hace ' . $diferenciaFecha->i . ' minutos';
                    break;
                case ( ($diferenciaFecha->y == 0) && ($diferenciaFecha->m == 0) && ($diferenciaFecha->d == 0) && ($diferenciaFecha->h <= 23) ) :
                    $valor = $diferenciaFecha->h;
                    $texto = ($valor <= 1) ? 'Hace ' . $diferenciaFecha->h . ' hora' : 'Hace ' . $diferenciaFecha->h . ' horas';
                    break;
                case ( ($diferenciaFecha->y == 0) && ($diferenciaFecha->m == 0) && ($diferenciaFecha->d >= 1) ) :
                    $dia = $diferenciaFecha->d;
                    $sem = round($dia / 7);
                    if ($sem == 0) {
                        $valor = $diferenciaFecha->d;
                        $texto = ($valor <= 1) ? 'Hace ' . $diferenciaFecha->d . ' día' : 'Hace ' . $diferenciaFecha->d . ' días';
                    } else {
                        $valor = $sem;
                        $texto = ($valor <= 1) ? 'Hace ' . $sem . ' semana' : 'Hace ' . $sem . ' semanas';
                    }
                    break;
                case ( ($diferenciaFecha->y == 0) && ($diferenciaFecha->m <= 11) ) :
                    $valor = $diferenciaFecha->m;
                    $texto = ($valor <= 1) ? 'Hace ' . $diferenciaFecha->m . ' mes' : 'Hace ' . $diferenciaFecha->m . ' meses';
                    break;
                case ( ($diferenciaFecha->y >= 1) ) :
                    $valor = $diferenciaFecha->y;
                    $texto = ($valor <= 1) ? 'Hace ' . $diferenciaFecha->y . ' año' : 'Hace ' . $diferenciaFecha->y . ' años';
                    break;
            }
            return $texto;
        }
    }

    public function restarFechas($fechaInicio, $fechaFinal, $atributos = 'y|m|d|h|i|s') {
        if (strtotime($fechaInicio, time()) > strtotime($fechaFinal, time())) {
            return '';
        } else {
            $obtienFechaInicio = new DateTime($fechaInicio);
            $obtieneFechaFinal = new DateTime($fechaFinal);
            $diferenciaFecha = $obtienFechaInicio->diff($obtieneFechaFinal);
            $texto = '';
            $obtieneAtributos = explode('|', $atributos);
            foreach ($obtieneAtributos as $items) {
                switch ($items) {
                    case 'y':
                        if ($diferenciaFecha->y == 1) {
                            $texto .= $diferenciaFecha->y . ' año - ';
                        } elseif ($diferenciaFecha->y > 1) {
                            $texto .= $diferenciaFecha->y . ' años - ';
                        }
                        break;
                    case 'm':
                        if ($diferenciaFecha->m == 1) {
                            $texto .= $diferenciaFecha->m . ' mes - ';
                        } elseif ($diferenciaFecha->m > 1) {
                            $texto .= $diferenciaFecha->m . ' meses - ';
                        }
                        break;
                    case 'd':
                        if ($diferenciaFecha->d == 1) {
                            $texto .= $diferenciaFecha->d . ' dia - ';
                        } elseif ($diferenciaFecha->d > 1) {
                            $texto .= $diferenciaFecha->d . ' dias - ';
                        }
                        break;
                    case 'h':
                        if ($diferenciaFecha->h == 1) {
                            $texto .= $diferenciaFecha->h . ' hora - ';
                        } elseif ($diferenciaFecha->h > 1) {
                            $texto .= $diferenciaFecha->h . ' horas - ';
                        }
                        break;
                    case 'i':
                        if ($diferenciaFecha->i == 1) {
                            $texto .= $diferenciaFecha->i . ' minuto - ';
                        } elseif ($diferenciaFecha->i > 1) {
                            $texto .= $diferenciaFecha->i . ' minutos - ';
                        }
                        break;
                    case 's':
                        if ($diferenciaFecha->s == 1) {
                            $texto .= $diferenciaFecha->s . ' segundo - ';
                        } elseif ($diferenciaFecha->s > 1) {
                            $texto .= $diferenciaFecha->s . ' segundos - ';
                        }
                        break;
                }
            }
            $texto = trim(trim($texto), '-');
            return $texto;
        }
    }

    public function facebookComment($url = '') {
        $string = '';
        if ($url == '') {
            $obtieneUrl = 'https://developers.facebook.com/docs/plugins/comments#configurator';
        } else {
            $obtieneUrl = $url;
        }
        $string .= '<div id="fb-root"></div>';
        $string .= '<script>(function(d, s, id) {';
        $string .= 'var js, fjs = d.getElementsByTagName(s)[0];';
        $string .= 'if (d.getElementById(id)) return;';
        $string .= 'js = d.createElement(s); js.id = id;';
        $string .= 'js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";';
        $string .= 'fjs.parentNode.insertBefore(js, fjs);';
        $string .= '}(document, \'script\', \'facebook-jssdk\'));</script>';
        $string .= '<div class="fb-comments" data-href="' . $obtieneUrl . '" data-width="100%" data-numposts="5"></div>';
        return $string;
    }

    public function apiGoogleMaps($datosApi, $direccion = 'Mi Dirección') {
        if (!empty($datosApi) && is_array($datosApi)) {
            $datosApiDefecto = array(
                'apiKey' => 'AIzaSyDGWE6o7XnTwoDFQA-I2b0tIAeYHKCZcUc',
                'estiloId' => 'googleMapa',
                'lat' => '-12.03996916657719',
                'lng' => '-77.03303234127202',
                'zoom' => '15',
                'tipoMapa' => 'ROADMAP', // HYBRID - ROADMAP - SATELLITE - TERRAIN
                'activarScroll' => FALSE,
                'draggable' => FALSE
            );
            $datosApi = array_merge($datosApiDefecto, $datosApi);
            foreach ($datosApi as $k => $v) {
                $this->$k = $v;
            }
            if ($this->activarScroll) {
                $activarScroll = 'true';
            } else {
                $activarScroll = 'false';
            }
            if ($this->draggable) {
                $draggable = 'true';
            } else {
                $draggable = 'false';
            }
            $texto = '';
            $texto .= '<script src="https://maps.googleapis.com/maps/api/js?sensor=true&key=' . $this->apiKey . '"></script>';
            $texto .= '<script>';
            $texto .= 'var map;';
            $texto .= 'function initialize() {';
            $texto .= 'var mapOptions = { zoom: ' . $this->zoom . ', draggable: ' . $draggable . ', center: {lat: ' . $this->lat . ', lng: ' . $this->lng . '}, mapTypeId: google.maps.MapTypeId.' . $this->tipoMapa . ', scrollwheel: ' . $activarScroll . ' } ;';
            $texto .= 'map = new google.maps.Map(document.getElementById(\'' . $this->estiloId . '\'), mapOptions);';
            $texto .= 'var marker = new google.maps.Marker( {position: {lat: ' . $this->lat . ', lng: ' . $this->lng . '}, map: map} );';
            $texto .= 'var infowindow = new google.maps.InfoWindow({ content: \'<p>Dirección: ' . $direccion . '</p>\' });';
            $texto .= 'google.maps.event.addListener(marker, \'click\', function() { infowindow.open(map, marker); });';
            $texto .= '}';
            $texto .= 'google.maps.event.addDomListener(window, \'load\', initialize);';
            $texto .= '</script>';
            return $texto;
        } else {
            return FALSE;
        }
    }

    public function resaltarTexto($contenido, $palabra, $etiquetaInicial = '<b>', $etiquetaFinal = '</b>') {
        if ($contenido !== '') {
            if (is_array($palabra) && !empty($palabra)) {
                $tmp = $contenido;
                foreach ($palabra as $k => $v) {
                    $tmpEnlace = $etiquetaInicial . '<a href="' . $v . '">' . $k . '</a>' . $etiquetaFinal;
                    if (strpos($tmp, $tmpEnlace) === FALSE) {
//                        $tmp = preg_replace('/('.preg_quote($k, '/').')/i'.('true' ? 'u' : ''), $etiquetaInicial.'<a href="'.$v.'">'.'\\1'.'</a>'.$etiquetaFinal, $tmp);
                        $tmp = preg_replace('/(' . preg_quote($k, '/') . ')/' . ('true' ? 'u' : ''), $etiquetaInicial . '<a href="' . $v . '">' . '\\1' . '</a>' . $etiquetaFinal, $tmp, 1);
                    } else {
                        continue;
                    }
                }
                $generaContenido = $tmp;
            } else {
                $generaContenido = $contenido;
            }
            return $generaContenido;
        } else {
            return FALSE;
        }
    }

    public function datatable($opciones, $cssClase) {
        /*
         * 
         * EXAMPLE
         * -------
         * 
         * $opciones = array(
         *      'bPaginate' => FALSE, 
         *      'bFilter' => TRUE, 
         *      'bLengthChange' => FALSE,
         *      'bInfo' => FALSE
         * );
         * 
         */
        $datos = array(
            'bAutoWidth' => FALSE,
            'oLanguage' => array(
                'sEmptyTable' => 'No hay registros disponibles',
                'sInfo' => 'Hay _TOTAL_ registros. Mostrando del _START_ al _END_',
                'sLoadingRecords' => 'Por favor espere. Cargando...',
                'sLengthMenu' => ''
                . '<select class="form-control selectpicker">'
                . '<option value="5">Mostrar [5] registros</option>'
                . '<option value="10">Mostrar [10] registros</option>'
                . '<option value="20">Mostrar [20] registros</option>'
                . '<option value="50">Mostrar [50] registros</option>'
                . '<option value="100">Mostrar [100] registros</option>'
                . '<option value="-1">Todos los registros</option>'
                . '</select>',
                'oPaginate' => array(
                    'sLast' => 'Última página',
                    'sFirst' => 'Primera',
                    'sNext' => 'Siguiente',
                    'sPrevious' => 'Anterior'
                )
            )
        );
        $generaDatos = array_merge($opciones, $datos);
        $resultado = array(
            'jquery' => json_encode($generaDatos, JSON_NUMERIC_CHECK),
            'clases' => $cssClase
        );
        return $resultado;
    }

    public function colorbox($opciones, $cssClase, $ancho = '100%', $alto = '100%') {
        $datos = array(
            'innerWidth' => $ancho,
            'innerHeight' => $alto,
            'fixed' => TRUE,
            'scrolling' => TRUE,
            'overlayClose' => FALSE
        );
        $generaDatos = array_merge($opciones, $datos);
        $generaDatos = json_encode($generaDatos, JSON_NUMERIC_CHECK);
        $resultado = array(
            'jquery' => preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/', '$1:', $generaDatos),
            'clases' => $cssClase
        );
        return $resultado;
    }

    public function datepicker($tipoCalendario, $infoCalendario, $cssClase, $rangoAnos = '1900:+0', $minFecha = '', $maxFecha = '') {
        /*
         * EXAMPLE
         * -------
         * 
         * $rangoAnos => -70:+0 // Rango de Fechas entre la fecha actual y 70 años atras.
         * $minFecha => -0D // Minima fecha apartir del dia de hoy.
         * $maxFecha => +11D +5M -5Y // Maxima fecha permitida hasta hace 5 años agregando 5 meses y 11 dias.
         * 
         * $infoCalendario = array(
         *      'dateFormat' => 'dd-mm-yy', 
         *      'numberOfMonths' => 1
         * );
         * $this->datepicker('defecto', $infoCalendario, $cssClase, $rangoAnos, $minFecha, $maxFecha);
         * 
         */


        /* CONTINUE */
        $datos = array(
            'direction' => TRUE,
            'showOtherMonths' => TRUE,
            'selectOtherMonths' => TRUE,
            'changeMonth' => TRUE,
        );
        $opciones = array();
        switch ($tipoCalendario) {
            case 'defecto':
                $opciones = array(
                );
                $opciones = array_merge($opciones, $infoCalendario);
                break;
            case 'estandar':
                $opciones = array(
                    'changeYear' => TRUE,
                    'yearRange' => $rangoAnos
                );
                $opciones = array_merge($opciones, $infoCalendario);
                break;
            case 'nacimiento':
                $opciones = array(
                    'changeYear' => TRUE,
                    'yearRange' => $rangoAnos,
                    'maxDate' => $maxFecha
                );
                $opciones = array_merge($opciones, $infoCalendario);
                break;
            case 'futuro':
                $opciones = array(
                    'changeYear' => TRUE,
                    'minDate' => $minFecha
                );
                $opciones = array_merge($opciones, $infoCalendario);
                break;
        }
        $generaDatos = array_merge($datos, $opciones);
        $resultado = array(
            'jquery' => json_encode($generaDatos, JSON_NUMERIC_CHECK),
            'clases' => $cssClase
        );
        return $resultado;
    }

    public function encriptaInfo($valor) {
        $this->ci->mcrypted->load($this->items['insEncriptacionSesion']);
        return $this->ci->mcrypted->encode($valor);
    }

    public function desencriptaInfo($valor) {
        $this->ci->mcrypted->load($this->items['insEncriptacionSesion']);
        return $this->ci->mcrypted->decode($valor);
    }

    public function creaSesion($datos, $valor = NULL) {
        @session_start();
        $this->ci->mcrypted->load($this->items['insEncriptacionSesion']);
        if (is_array($datos)) {
            foreach ($datos as $k => $v) {
                unset($_SESSION[$k]);
                $_SESSION[$k] = $this->ci->mcrypted->encode($v);
            }
        } else {
            if (is_null($valor)) {
                return FALSE;
            } else {
                unset($_SESSION[$datos]);
                $_SESSION[$datos] = $this->ci->mcrypted->encode($valor);
            }
        }
    }

    public function obtieneSesion($datos) {
        @session_start();
        $this->ci->mcrypted->load($this->items['insEncriptacionSesion']);
        if (is_array($datos)) {
            foreach ($datos as $k => $v) {
                if (isset($_SESSION[$k])) {
                    $obtieneValor[] = $this->ci->mcrypted->decode($_SESSION[$k]);
                } else {
                    return FALSE;
                }
            }
            return $obtieneValor;
        } else {
            if (isset($_SESSION[$datos])) {
                $obtieneValor = $this->ci->mcrypted->decode($_SESSION[$datos]);
            } else {
                return FALSE;
            }
            return $obtieneValor;
        }
    }

    public function eliminaSesion($datos) {
        @session_start();
        if (is_array($datos)) {
            foreach ($datos as $k => $v) {
                unset($_SESSION[$k]);
            }
        } else {
            unset($_SESSION[$datos]);
        }
    }

    public function destruyeSesion() {
        @session_start();
        $_SESSION = array();
        @session_unset();
        @session_destroy();
        @session_regenerate_id(TRUE);
    }

    public function parimpar($numero) {
        return (($numero % 2) == 0) ? true : false;
    }

    public function minificarHtml($input) {
        if (trim($input) === "") {
            return $input;
        }
        // Remove extra white-space(s) between HTML attribute(s)
        $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
            return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
        }, str_replace("\r", "", $input));
        // Minify inline CSS declaration(s)
        if (strpos($input, ' style=') !== false) {
            $input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
                return '<' . $matches[1] . ' style=' . $matches[2] . minify_css($matches[3]) . $matches[2];
            }, $input);
        }
        return preg_replace(
                array(
            // t = text
            // o = tag open
            // c = tag close
            // Keep important white-space(s) after self-closing HTML tag(s)
            '#<(img|input)(>| .*?>)#s',
            // Remove a line break and two or more white-space(s) between tag(s)
            '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
            '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
            '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
            '#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
            '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
            '#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
            // Remove HTML comment(s) except IE comment(s)
            '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
                ), array(
            '<$1$2</$1>',
            '$1$2$3',
            '$1$2$3',
            '$1$2$3$4$5',
            '$1$2$3$4$5$6$7',
            '$1$2$3',
            '<$1$2',
            '$1 ',
            '$1',
            ""
                ), $input);
    }

    public function minificarCss($input) {
        if (trim($input) === "") {
            return $input;
        }
        return preg_replace(
                array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
                ), array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2'
                ), $input);
    }

    public function minificarJs($input) {
        if (trim($input) === "") {
            return $input;
        }
        return preg_replace(
                array(
            // Remove comment(s)
            '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
            // Remove white-space(s) outside the string and regex
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
            // Remove the last semicolon
            '#;+\}#',
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
            '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
            // --ibid. From `foo['bar']` to `foo.bar`
            '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
                ), array(
            '$1',
            '$1$2',
            '}',
            '$1$3',
            '$1.$3'
                ), $input);
    }

    public function is_html($string) {
        return $string != strip_tags($string) ? TRUE : FALSE;
    }

    public function is_url($text) {
        return filter_var($text, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== FALSE;
    }

    public function tags($string, $encoding = 'ISO-8859-1') {
        $string = trim(strip_tags(html_entity_decode(urldecode($string))));
        if (empty($string)) {
            return false;
        }

        $extras = array(
            'p' => array('ante', 'bajo', 'con', 'contra', 'desde', 'durante', 'entre',
                'hacia', 'hasta', 'mediante', 'para', 'por', 'pro', 'segun',
                'sin', 'sobre', 'tras', 'via'
            ),
            'a' => array('los', 'las', 'una', 'unos', 'unas', 'este', 'estos', 'ese',
                'esos', 'aquel', 'aquellos', 'esta', 'estas', 'esa', 'esas',
                'aquella', 'aquellas', 'usted', 'nosotros', 'vosotros',
                'ustedes', 'nos', 'les', 'nuestro', 'nuestra', 'vuestro',
                'vuestra', 'mis', 'tus', 'sus', 'nuestros', 'nuestras',
                'vuestros', 'vuestras'
            ),
            'o' => array('esto', 'que'),
        );

        $string = strtr(mb_strtolower((string) $string, $encoding), 'âàåáäèéêëïîìíôöòóúûüùñ', 'aaaaaeeeeiiiioooouuuun'
        );
        if (preg_match_all('/\pL{3,}/s', $string, $m)) {
            $m = array_diff(array_unique($m[0]), $extras['p'], $extras['a'], $extras['o']);
        }
        return $m;
    }

    public function addSlashtag($string, $openTag = '»', $closeTag = '«') {
        $stmString = str_replace('"', "'", $string);
        $count = mb_substr_count($stmString, "'");
        $temp = $stmString;
        for ($i = 1; $i <= $count; $i++) {
            if (($i % 2) == 0) {
                $temp = preg_replace(array("/'/"), array($closeTag), $temp, 1);
            } else {
                $temp = preg_replace(array("/'/"), array($openTag), $temp, 1);
            }
        }
        return $temp;
    }

    public function exeCurl($url, $userAgent, $print = FALSE) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        if ($print === TRUE) {
            $resultado = curl_exec($ch);
            return $resultado;
        } else {
            curl_exec($ch);
        }
    }
   
    public function agregarDocumento($documento = FALSE, $codigoDoc = '', $nroDocumento = '', $idAlta = ''){
        for ($i = 0; $i < count($documento); $i++) {
            $delimitar = explode('.', $documento[$i]['name']);
            $codigoDocumento = $codigoDoc;
            $delimitar[0] = $codigoDocumento . "-" . $nroDocumento;
            $transformaArchivo = $delimitar[0];

            $opciones = array(
                'nombreEmpresa' => '',
                'cantidadCopia' => 1
            );

            /*  VALIDA SI EL FILE DEL ALTA EXISTE */

            if(!is_dir('public/files/' . $nroDocumento)) { mkdir('public/files/' . $nroDocumento,0755,TRUE); }

            $obtieneArchivo = $this->almacenarArchivoAltas($documento, $codigoDocumento, $nroDocumento, 'public/files/' . $nroDocumento, $opciones, TRUE);
            $listaUbicacion = 'public/files/' . $nroDocumento . '/' . $obtieneArchivo;
            //$listaArchivos[] = $obtieneArchivo;                                
        }

        return $obtieneArchivo;
    }
    
    public function unidad($numuero) {
        switch ($numuero) {
            case 9: {
                    $numu = "NUEVE";
                    break;
                }
            case 8: {
                    $numu = "OCHO";
                    break;
                }
            case 7: {
                    $numu = "SIETE";
                    break;
                }
            case 6: {
                    $numu = "SEIS";
                    break;
                }
            case 5: {
                    $numu = "CINCO";
                    break;
                }
            case 4: {
                    $numu = "CUATRO";
                    break;
                }
            case 3: {
                    $numu = "TRES";
                    break;
                }
            case 2: {
                    $numu = "DOS";
                    break;
                }
            case 1: {
                    $numu = "UN";
                    break;
                }
            case 0: {
                    $numu = "";
                    break;
                }
        }
        return $numu;
    }

    public function decena($numdero) {

        if ($numdero >= 90 && $numdero <= 99) {
            $numd = "NOVENTA ";
            if ($numdero > 90)
                $numd = $numd . "Y " . ($this->unidad($numdero - 90));
        } else if ($numdero >= 80 && $numdero <= 89) {
            $numd = "OCHENTA ";
            if ($numdero > 80)
                $numd = $numd . "Y " . ($this->unidad($numdero - 80));
        } else if ($numdero >= 70 && $numdero <= 79) {
            $numd = "SETENTA ";
            if ($numdero > 70)
                $numd = $numd . "Y " . ($this->unidad($numdero - 70));
        } else if ($numdero >= 60 && $numdero <= 69) {
            $numd = "SESENTA ";
            if ($numdero > 60)
                $numd = $numd . "Y " . ($this->unidad($numdero - 60));
        } else if ($numdero >= 50 && $numdero <= 59) {
            $numd = "CINCUENTA ";
            if ($numdero > 50)
                $numd = $numd . "Y " . ($this->unidad($numdero - 50));
        } else if ($numdero >= 40 && $numdero <= 49) {
            $numd = "CUARENTA ";
            if ($numdero > 40)
                $numd = $numd . "Y " . ($this->unidad($numdero - 40));
        } else if ($numdero >= 30 && $numdero <= 39) {
            $numd = "TREINTA ";
            if ($numdero > 30)
                $numd = $numd . "Y " . ($this->unidad($numdero - 30));
        } else if ($numdero >= 20 && $numdero <= 29) {
            if ($numdero == 20)
                $numd = "VEINTE ";
            else
                $numd = "VEINTI" . ($this->unidad($numdero - 20));
        } else if ($numdero >= 10 && $numdero <= 19) {
            switch ($numdero) {
                case 10: {
                        $numd = "DIEZ ";
                        break;
                    }
                case 11: {
                        $numd = "ONCE ";
                        break;
                    }
                case 12: {
                        $numd = "DOCE ";
                        break;
                    }
                case 13: {
                        $numd = "TRECE ";
                        break;
                    }
                case 14: {
                        $numd = "CATORCE ";
                        break;
                    }
                case 15: {
                        $numd = "QUINCE ";
                        break;
                    }
                case 16: {
                        $numd = "DIECISEIS ";
                        break;
                    }
                case 17: {
                        $numd = "DIECISIETE ";
                        break;
                    }
                case 18: {
                        $numd = "DIECIOCHO ";
                        break;
                    }
                case 19: {
                        $numd = "DIECINUEVE ";
                        break;
                    }
            }
        } else
            $numd = $this->unidad($numdero);
        return $numd;
    }

    public function centena($numc) {
        if ($numc >= 100) {
            if ($numc >= 900 && $numc <= 999) {
                $numce = "NOVECIENTOS ";
                if ($numc > 900)
                    $numce = $numce . ($this->decena($numc - 900));
            } else if ($numc >= 800 && $numc <= 899) {
                $numce = "OCHOCIENTOS ";
                if ($numc > 800)
                    $numce = $numce . ($this->decena($numc - 800));
            } else if ($numc >= 700 && $numc <= 799) {
                $numce = "SETECIENTOS ";
                if ($numc > 700)
                    $numce = $numce . ($this->decena($numc - 700));
            } else if ($numc >= 600 && $numc <= 699) {
                $numce = "SEISCIENTOS ";
                if ($numc > 600)
                    $numce = $numce . ($this->decena($numc - 600));
            } else if ($numc >= 500 && $numc <= 599) {
                $numce = "QUINIENTOS ";
                if ($numc > 500)
                    $numce = $numce . ($this->decena($numc - 500));
            } else if ($numc >= 400 && $numc <= 499) {
                $numce = "CUATROCIENTOS ";
                if ($numc > 400)
                    $numce = $numce . ($this->decena($numc - 400));
            } else if ($numc >= 300 && $numc <= 399) {
                $numce = "TRESCIENTOS ";
                if ($numc > 300)
                    $numce = $numce . ($this->decena($numc - 300));
            } else if ($numc >= 200 && $numc <= 299) {
                $numce = "DOSCIENTOS ";
                if ($numc > 200)
                    $numce = $numce . ($this->decena($numc - 200));
            } else if ($numc >= 100 && $numc <= 199) {
                if ($numc == 100)
                    $numce = "CIEN ";
                else
                    $numce = "CIENTO " . ($this->decena($numc - 100));
            }
        } else
            $numce = $this->decena($numc);

        return $numce;
    }

    public function miles($nummero) {
        if ($nummero >= 1000 && $nummero < 2000) {
            $numm = "MIL " . ($this->centena($nummero % 1000));
        }
        if ($nummero >= 2000 && $nummero < 10000) {
            $numm = $this->unidad(Floor($nummero / 1000)) . " MIL " . ($this->centena($nummero % 1000));
        }
        if ($nummero < 1000)
            $numm = $this->centena($nummero);

        return $numm;
    }

    public function decmiles($numdmero) {
        if ($numdmero == 10000)
            $numde = "DIEZ MIL";
        if ($numdmero > 10000 && $numdmero < 20000) {
            $numde = $this->decena(Floor($numdmero / 1000)) . "MIL " . ($this->centena($numdmero % 1000));
        }
        if ($numdmero >= 20000 && $numdmero < 100000) {
            $numde = $this->decena(Floor($numdmero / 1000)) . " MIL " . ($this->miles($numdmero % 1000));
        }
        if ($numdmero < 10000)
            $numde = $this->miles($numdmero);

        return $numde;
    }

    public function cienmiles($numcmero) {
        if ($numcmero == 100000)
            $num_letracm = "CIEN MIL";
        if ($numcmero >= 100000 && $numcmero < 1000000) {
            $num_letracm = $this->centena(Floor($numcmero / 1000)) . " MIL " . ($this->centena($numcmero % 1000));
        }
        if ($numcmero < 100000)
            $num_letracm = $this->decmiles($numcmero);
        return $num_letracm;
    }

    public function millon($nummiero) {
        if ($nummiero >= 1000000 && $nummiero < 2000000) {
            $num_letramm = "UN MILLON " . ($this->cienmiles($nummiero % 1000000));
        }
        if ($nummiero >= 2000000 && $nummiero < 10000000) {
            $num_letramm = $this->unidad(Floor($nummiero / 1000000)) . " MILLONES " . ($this->cienmiles($nummiero % 1000000));
        }
        if ($nummiero < 1000000)
            $num_letramm = $this->cienmiles($nummiero);

        return $num_letramm;
    }

    public function decmillon($numerodm) {
        if ($numerodm == 10000000)
            $num_letradmm = "DIEZ MILLONES";
        if ($numerodm > 10000000 && $numerodm < 20000000) {
            $num_letradmm = $this->decena(Floor($numerodm / 1000000)) . "MILLONES " . ($this->cienmiles($numerodm % 1000000));
        }
        if ($numerodm >= 20000000 && $numerodm < 100000000) {
            $num_letradmm = $this->decena(Floor($numerodm / 1000000)) . " MILLONES " . ($this->millon($numerodm % 1000000));
        }
        if ($numerodm < 10000000)
            $num_letradmm = $this->millon($numerodm);

        return $num_letradmm;
    }

    public function cienmillon($numcmeros) {
        if ($numcmeros == 100000000)
            $num_letracms = "CIEN MILLONES";
        if ($numcmeros >= 100000000 && $numcmeros < 1000000000) {
            $num_letracms = $this->centena(Floor($numcmeros / 1000000)) . " MILLONES " . ($this->millon($numcmeros % 1000000));
        }
        if ($numcmeros < 100000000)
            $num_letracms = $this->decmillon($numcmeros);
        return $num_letracms;
    }

    public function milmillon($nummierod) {
        if ($nummierod >= 1000000000 && $nummierod < 2000000000) {
            $num_letrammd = "MIL " . ($this->cienmillon($nummierod % 1000000000));
        }
        if ($nummierod >= 2000000000 && $nummierod < 10000000000) {
            $num_letrammd = unidad(Floor($nummierod / 1000000000)) . " MIL " . ($this->cienmillon($nummierod % 1000000000));
        }
        if ($nummierod < 1000000000)
            $num_letrammd = $this->cienmillon($nummierod);

        return $num_letrammd;
    }

    public function convertir($numero) {
        $numf = $this->milmillon($numero);
        return $numf . " CON 00/100 SOLES";
    }
    
    function eliminar_tildes($cadena){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        //$cadena = utf8_encode($cadena);
        
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U'),
            $cadena );

        
        return strtoupper($cadena);
    }    
    
    function eliminar_tildes2($cadena){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        //$cadena = utf8_encode($cadena);
        
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U'),
            $cadena );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        return strtoupper($cadena);
    }

    public function busca_edad($fecha_nacimiento){
        $dia=date("d");
        $mes=date("m");
        $ano=date("Y");

        $dianaz=date("d",strtotime($fecha_nacimiento));
        $mesnaz=date("m",strtotime($fecha_nacimiento));
        $anonaz=date("Y",strtotime($fecha_nacimiento));

        if (($mesnaz == $mes) && ($dianaz > $dia)) {
        $ano=($ano-1); }

        if ($mesnaz > $mes) {
        $ano=($ano-1);}

        $edad=($ano-$anonaz);
        return $edad;
    }
    
    /**
     * Genera un código alfanumérico aleatorio
     * 
     * @param int $longitud Cantidad de caracteres del código
     * @return string Código alfanumérico generado
     */
    public function generarCodigo($longitud = 8) {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $codigo = '';
        $max = strlen($caracteres) - 1;
        
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[random_int(0, $max)];
        }
        
        return $codigo;
    }
}
