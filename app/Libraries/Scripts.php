<?php

namespace App\Libraries;

class Scripts {

    public function __construct(){
		$this->items['baseUrl'] = base_url();        
		$this->items['basePath'] = FCPATH . 'public/mailings/';
    }

    public function convertirAWebP($idProducto, $rutaJpg, $tipoArchivo){
        if ($tipoArchivo == 'image/jpeg' || $tipoArchivo == 'image/jpg') {
            // Cargar la imagen JPG
            $imagenOriginal = imagecreatefromjpeg($rutaJpg);

            // Ruta donde se guardará la imagen WebP
            $rutaWebp = FCPATH . 'public/anuncios/' . $idProducto . '/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Convertir y guardar la imagen en formato WebP
            imagewebp($imagenOriginal, $rutaWebp, 80);

            // Obtener el tamaño de la imagen en kb
            $tamano = filesize($rutaWebp) / 1024;

            //Arreglo de información de la imagen
            $this->imagen['nombre'] = pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';
            $this->imagen['tamano'] = $tamano;
            $this->imagen['ruta'] = $this->items['baseUrl'] . '/public/anuncios/' . $idProducto . '/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Liberar la memoria
            imagedestroy($imagenOriginal);

            // Eliminar la foto
            unlink($rutaJpg);

            return $this->imagen;
        }

        if ($tipoArchivo == 'image/png') {
            // Cargar la imagen JPG
            $imagenOriginal = imagecreatefrompng($rutaJpg);

            // Ruta donde se guardará la imagen WebP
            $rutaWebp = FCPATH . 'public/anuncios/' . $idProducto . '/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Convertir y guardar la imagen en formato WebP
            imagewebp($imagenOriginal, $rutaWebp, 80);

            // Obtener el tamaño de la imagen en kb
            $tamano = filesize($rutaWebp) / 1024;

            //Arreglo de información de la imagen
            $this->imagen['nombre'] = pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';
            $this->imagen['tamano'] = $tamano;
            $this->imagen['ruta'] = $this->items['baseUrl'] . '/public/anuncios/' . $idProducto . '/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Liberar la memoria
            imagedestroy($imagenOriginal);

            // Eliminar la foto
            unlink($rutaJpg);

            return $this->imagen;
        }
    }

    public function convertirFotoInspeccionAWebP($rutaJpg, $tipoArchivo){
        if ($tipoArchivo == 'image/jpeg' || $tipoArchivo == 'image/jpg') {
            // Cargar la imagen JPG
            $imagenOriginal = imagecreatefromjpeg($rutaJpg);

            // Ruta donde se guardará la imagen WebP
            $rutaWebp = FCPATH . '/public/inspeccion/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Convertir y guardar la imagen en formato WebP
            imagewebp($imagenOriginal, $rutaWebp, 80);

            // Obtener el tamaño de la imagen en kb
            $tamano = filesize($rutaWebp) / 1024;

            //Arreglo de información de la imagen
            $this->imagen['nombre'] = pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';
            $this->imagen['tamano'] = $tamano;
            $this->imagen['ruta'] = $this->items['baseUrl'] . '/public/inspeccion/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Liberar la memoria
            imagedestroy($imagenOriginal);

            // Eliminar la foto
            unlink($rutaJpg);

            return $this->imagen;
        }

        if ($tipoArchivo == 'image/png') {
            // Cargar la imagen JPG
            $imagenOriginal = imagecreatefrompng($rutaJpg);

            // Ruta donde se guardará la imagen WebP
            $rutaWebp = FCPATH . '/public/inspeccion/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Convertir y guardar la imagen en formato WebP
            imagewebp($imagenOriginal, $rutaWebp, 80);

            // Obtener el tamaño de la imagen en kb
            $tamano = filesize($rutaWebp) / 1024;

            //Arreglo de información de la imagen
            $this->imagen['nombre'] = pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';
            $this->imagen['tamano'] = $tamano;
            $this->imagen['ruta'] = $this->items['baseUrl'] . '/public/inspeccion/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Liberar la memoria
            imagedestroy($imagenOriginal);

            // Eliminar la foto
            unlink($rutaJpg);

            return $this->imagen;
        }
    }

    public function convertirBannerAWebP($rutaJpg, $tipoArchivo){
        if ($tipoArchivo == 'image/jpeg' || $tipoArchivo == 'image/jpg') {
            // Cargar la imagen JPG
            $imagenOriginal = imagecreatefromjpeg($rutaJpg);

            // Ruta donde se guardará la imagen WebP
            $rutaWebp = FCPATH . '/public/images/banners/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Convertir y guardar la imagen en formato WebP
            imagewebp($imagenOriginal, $rutaWebp, 80);

            // Obtener el tamaño de la imagen en kb
            $tamano = filesize($rutaWebp) / 1024;

            //Arreglo de información de la imagen
            $this->imagen['nombre'] = pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';
            $this->imagen['tamano'] = $tamano;
            $this->imagen['ruta'] = $this->items['baseUrl'] . '/public/images/banners/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Liberar la memoria
            imagedestroy($imagenOriginal);

            // Eliminar la foto
            unlink($rutaJpg);

            return $this->imagen;
        }

        if ($tipoArchivo == 'image/png') {
            // Cargar la imagen JPG
            $imagenOriginal = imagecreatefrompng($rutaJpg);

            // Ruta donde se guardará la imagen WebP
            $rutaWebp = FCPATH . '/public/images/banners/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Convertir y guardar la imagen en formato WebP
            imagewebp($imagenOriginal, $rutaWebp, 80);

            // Obtener el tamaño de la imagen en kb
            $tamano = filesize($rutaWebp) / 1024;

            //Arreglo de información de la imagen
            $this->imagen['nombre'] = pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';
            $this->imagen['tamano'] = $tamano;
            $this->imagen['ruta'] = $this->items['baseUrl'] . '/public/images/banners/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Liberar la memoria
            imagedestroy($imagenOriginal);

            // Eliminar la foto
            unlink($rutaJpg);

            return $this->imagen;
        }
    }

    public function convertirIconoAWebP($rutaJpg, $tipoArchivo){
        if ($tipoArchivo == 'image/jpeg' || $tipoArchivo == 'image/jpg') {
            // Cargar la imagen JPG
            $imagenOriginal = imagecreatefromjpeg($rutaJpg);

            // Ruta donde se guardará la imagen WebP
            $rutaWebp = FCPATH . '/public/images/categorias/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Convertir y guardar la imagen en formato WebP
            imagewebp($imagenOriginal, $rutaWebp, 80);

            // Obtener el tamaño de la imagen en kb
            $tamano = filesize($rutaWebp) / 1024;

            //Arreglo de información de la imagen
            $this->imagen['nombre'] = pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';
            $this->imagen['tamano'] = $tamano;
            $this->imagen['ruta'] = $this->items['baseUrl'] . '/public/images/categorias/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Liberar la memoria
            imagedestroy($imagenOriginal);

            // Eliminar la foto
            unlink($rutaJpg);

            return $this->imagen;
        }

        if ($tipoArchivo == 'image/png') {
            // Cargar la imagen JPG
            $imagenOriginal = imagecreatefrompng($rutaJpg);

            // Ruta donde se guardará la imagen WebP
            $rutaWebp = FCPATH . '/public/images/categorias/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Convertir y guardar la imagen en formato WebP
            imagewebp($imagenOriginal, $rutaWebp, 80);

            // Obtener el tamaño de la imagen en kb
            $tamano = filesize($rutaWebp) / 1024;

            //Arreglo de información de la imagen
            $this->imagen['nombre'] = pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';
            $this->imagen['tamano'] = $tamano;
            $this->imagen['ruta'] = $this->items['baseUrl'] . '/public/images/categorias/' . pathinfo($rutaJpg, PATHINFO_FILENAME) . '.webp';

            // Liberar la memoria
            imagedestroy($imagenOriginal);

            // Eliminar la foto
            unlink($rutaJpg);

            return $this->imagen;
        }
    }

    public function enviarMensajeGrupoTelegram($chat_id, $message, $bot_token) {
        $url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
    
        $data = [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'HTML' // Opcional: para permitir formato HTML
        ];
    
        // Usar cURL para enviar la solicitud
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true,
        ];
    
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);
    
        return $response;
    }

    public function crearUrl($texto){
        // Reemplazar letras con tildes
        $tildes = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú');
        $sustitutos = array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U');
        $texto_sin_tildes = str_replace($tildes, $sustitutos, $texto);

        // Reemplazar espacios
        $texto_final = strtolower(str_replace(' ', '-', $texto_sin_tildes));

        // Mostrar el resultado
        return $texto_final;
    }
    
    public function getPublicIP() {
        // create & initialize a curl session
        $curl = curl_init();

        // set our url with curl_setopt()
        curl_setopt($curl, CURLOPT_URL, "http://httpbin.org/ip");

        // return the transfer as a string, also with setopt()
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // curl_exec() executes the started curl session
        // $output contains the output string
        $output = curl_exec($curl);

        // close curl resource to free up system resources
        // (deletes the variable made by curl_init)
        curl_close($curl);

        $ip = json_decode($output, true);

        return $ip['origin'];
    }

    public function validarDuplicados($arreglo, $entidad){
        $longitudOriginal = count($arreglo);
        $respuesta = '';

        $unicos = array_unique($arreglo);
        $longitudDeUnicos = count($unicos);
        
        if($longitudOriginal > $longitudDeUnicos){
          $respuesta = "<li>Complete los campos sin repetir los(as) ".$entidad.".</li>";
        }

        return $respuesta;
    }

    public function crearContrasena(){
        //Carácteres para la contraseña
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";
        //Reconstruimos la contraseña segun la longitud que se quiera
        for($i=0;$i<8;$i++) {
           //obtenemos un caracter aleatorio escogido de la cadena de caracteres
           $password .= substr($str,rand(0,62),1); 
        }
        //Mostramos la contraseña generada
        return $password;           
    }
        
    public function crearCodigo($longitud) {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern[mt_rand(0,$max)];
        return strtolower($key);
    }
	

    public function correoAgendaVisita($nombres, $apellidos, $correoElectronico, $fecha, $direccion, $anuncio){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        //$to = 'backoffice@maqu.pe';
        $subject = '¡Tu visita se ha agendado con éxito!';
        $message = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
					<meta name="viewport" content="width=480, user-scalable=1" />
					<title>Mundo Maqu</title>
					<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
				</head>
				<body style="margin: 0; padding: 0; background-color:#F4F4F4">
					<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F4F4F4">
					<tr>
						<td align="center">
							<!-- ENCABEZADO - LOGO -->
							<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
								<tr>
									<td>
										<img src="https://mundomaqu.com/public/img/mailing/encabezado_logo.png" alt="Mundo Maqu" width="600" style="display: block; border: 0;" />
									</td>
								</tr>
							</table>
							
							<!-- CUERPO DEL MENSAJE -->
							<table style="background-color: #ffffff;" width="550" cellspacing="0" cellpadding="0" border="0">
								<tbody>
									<tr>
										<td width="500">
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-top: 0; margin-bottom: 10px; padding:0px 40px 0px;">¡Hola , <span style="color:#301B64;font-weight: bold;">'.$nombres . ' ' .$apellidos.'</span>! <br><br>Tu visita ha sido agendada con éxito. A continuación, los detalles:</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">
												🟨 Equipo a visitar: '.$anuncio.'<br/>
												📅 Fecha: '.date("d-m-Y", strtotime($fecha)).'<br/>
												🕒 Hora: '.date("H:i", strtotime($fecha)).'
											</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">🔎 ¿Qué debes saber?</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Puedes venir con tu técnico o acompañante.</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Nuestro equipo estará presente para mostrarte el estado de la máquina.</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si necesitas reprogramar, avísanos con anticipación.</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">📲 ¿Tienes dudas? Escríbenos al WhatsApp +51 904 497 062</p>
											<p style="text-align: left;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 50px; padding:0px 40px 0px;">Gracias por confiar en MAQU,<br><strong>Nos vemos pronto<br/>El equipo de mundomaqu.com</strong></p>
										</td>
									</tr>
								</tbody>
							</table>
							
							<!-- FOOTER -->
							<br>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: left;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
									<td style="padding: 0 8px; font-size: 14px; line-height: 50px; font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; color: #333333; text-align: center;" align="-">
										<img alt="Canal Cliente: siempre a su servicio" src="https://mundomaqu.com/public/img/mailing/auricular.png" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="50" height="50" border="0">
									</td>
									<td align="right" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: right;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
								</tr>
							</table>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>E-mail</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Atención al Cliente</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Whatsapp</p>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center; border-right: 0px solid #979797" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/correo.png" style="display: inline-block;" width="42" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;border-left: solid 1px;border-right: solid 1px;" >
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/llamada.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/wsp.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="mailto:info@maqu.pe" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">info@maqu.pe</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="tel:51904497062" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">+51 904 497 062</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="https://wa.link/k1rwcp" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">¡Escríbenos!</span></a>
									</td>
								</tr>
							</table>
							<br><br>
							<table style="border-radius: 0px 0px 45px 45px;" width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
								<tbody>
									<tr>
										<td width="600">
											<p style="text-align: center; font-size: 16px;font-family: Lexend, Arial;color: #301B64; margin-top: 20px;">El marketplace de maquinaria pesada</p>
											<p style="text-align: center;font-size: 12px;font-family: Lexend, Arial;color: #301B64;margin-bottom: 5px;">S&iacute;guenos en redes sociales</p>
										</td>
									</tr>
									<tr>
										<td width="600">
											<p style="text-align: center;font-size: 12px;font-family:Lexend, Arial;color: #606060;">
												<a href="https://www.facebook.com/mundomaqu" style="color:#301B64">Facebook</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.instagram.com/mundo.maqu/" style="color:#301B64">Instagram</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.tiktok.com/@maquoficial" style="color:#301B64">Tiktok</a></p>
										</td>
									</tr>
								</tbody>
							</table>
							<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
								<tbody>
									<tr>
										<td width="550">
											<p style="color: #301B64;text-align: center;font-size: 10px;font-family: Lexend, Arial;padding-bottom: 10px; padding-top: 15px;"> 
												Copyright © 2024 Ricardo Barcena, All rights reserved
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</html>
        ';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        //$email->send();
        if (!$email->send(false)) {
            // Si falla el envío, mostrar los errores
            //echo $email->printDebugger(['headers', 'subject', 'body']);
        } else {
            //echo 'Email enviado con éxito.';
        }
    }
	

    public function correoReAgendaVisita($nombres, $apellidos, $correoElectronico, $fecha, $direccion, $anuncio){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        //$to = 'backoffice@maqu.pe';
        $subject = 'Nueva fecha para tu visita con MAQU';
        $message = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
					<meta name="viewport" content="width=480, user-scalable=1" />
					<title>Mundo Maqu</title>
					<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
				</head>
				<body style="margin: 0; padding: 0; background-color:#F4F4F4">
					<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F4F4F4">
					<tr>
						<td align="center">
							<!-- ENCABEZADO - LOGO -->
							<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
								<tr>
									<td>
										<img src="https://mundomaqu.com/public/img/mailing/encabezado_logo.png" alt="Mundo Maqu" width="600" style="display: block; border: 0;" />
									</td>
								</tr>
							</table>
							
							<!-- CUERPO DEL MENSAJE -->
							<table style="background-color: #ffffff;" width="550" cellspacing="0" cellpadding="0" border="0">
								<tbody>
									<tr>
										<td width="500">
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-top: 0; margin-bottom: 10px; padding:0px 40px 0px;">¡Hola , <span style="color:#301B64;font-weight: bold;">'.$nombres . ' ' .$apellidos.'</span>! <br><br>Queremos informarte que hemos realizado una reprogramación de tu visita. A continuación, te compartimos los nuevos detalles:</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">
												🟨 Equipo a visitar: '.$anuncio.'<br/>
												📅 Fecha: '.date("d-m-Y", strtotime($fecha)).'<br/>
												🕒 Hora: '.date("H:i", strtotime($fecha)).'
											</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">🔎 Recuerda que:</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Puedes venir con tu técnico o acompañante.</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Nuestro equipo estará presente para mostrarte el estado de la máquina.</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si esta nueva fecha no te funciona, no hay problema. Escríbenos para coordinar otra.</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">📲 ¿Tienes dudas? Escríbenos al WhatsApp +51 904 497 062</p>
											<p style="text-align: left;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 50px; padding:0px 40px 0px;">Gracias por tu comprensión y por seguir confiando en MAQU.<br/>¡Nos vemos pronto!<br/>El equipo de mundomaqu.com</strong></p>
										</td>
									</tr>
								</tbody>
							</table>
							
							<!-- FOOTER -->
							<br>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: left;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
									<td style="padding: 0 8px; font-size: 14px; line-height: 50px; font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; color: #333333; text-align: center;" align="-">
										<img alt="Canal Cliente: siempre a su servicio" src="https://mundomaqu.com/public/img/mailing/auricular.png" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="50" height="50" border="0">
									</td>
									<td align="right" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: right;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
								</tr>
							</table>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>E-mail</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Atención al Cliente</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Whatsapp</p>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center; border-right: 0px solid #979797" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/correo.png" style="display: inline-block;" width="42" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;border-left: solid 1px;border-right: solid 1px;" >
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/llamada.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/wsp.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="mailto:info@maqu.pe" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">info@maqu.pe</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="tel:51904497062" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">+51 904 497 062</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="https://wa.link/k1rwcp" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">¡Escríbenos!</span></a>
									</td>
								</tr>
							</table>
							<br><br>
							<table style="border-radius: 0px 0px 45px 45px;" width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
								<tbody>
									<tr>
										<td width="600">
											<p style="text-align: center; font-size: 16px;font-family: Lexend, Arial;color: #301B64; margin-top: 20px;">El marketplace de maquinaria pesada</p>
											<p style="text-align: center;font-size: 12px;font-family: Lexend, Arial;color: #301B64;margin-bottom: 5px;">S&iacute;guenos en redes sociales</p>
										</td>
									</tr>
									<tr>
										<td width="600">
											<p style="text-align: center;font-size: 12px;font-family:Lexend, Arial;color: #606060;">
												<a href="https://www.facebook.com/mundomaqu" style="color:#301B64">Facebook</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.instagram.com/mundo.maqu/" style="color:#301B64">Instagram</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.tiktok.com/@maquoficial" style="color:#301B64">Tiktok</a></p>
										</td>
									</tr>
								</tbody>
							</table>
							<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
								<tbody>
									<tr>
										<td width="550">
											<p style="color: #301B64;text-align: center;font-size: 10px;font-family: Lexend, Arial;padding-bottom: 10px; padding-top: 15px;"> 
												Copyright © 2024 Ricardo Barcena, All rights reserved
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</html>
        ';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        //$email->send();
        if (!$email->send(false)) {
            // Si falla el envío, mostrar los errores
            //echo $email->printDebugger(['headers', 'subject', 'body']);
        } else {
            //echo 'Email enviado con éxito.';
        }
    }
    


    /* CRON */

    /* CORREO SEGUIMIENTO DE CONTACTO (5 DIAS) */
    public function correoSeguimientoContactoCincoDias($nombresContacto, $nombres, $apellidos, $correoElectronico){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        //$to = 'backoffice@maqu.pe';
        $subject = 'Seguimiento pendiente – Contacto con '.$nombresContacto.'?';
        $message = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
					<meta name="viewport" content="width=480, user-scalable=1" />
					<title>Mundo Maqu</title>
					<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
				</head>
				<body style="margin: 0; padding: 0; background-color:#F4F4F4">
					<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F4F4F4">
					<tr>
						<td align="center">
							<!-- ENCABEZADO - LOGO -->
							<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
								<tr>
									<td>
										<img src="https://mundomaqu.com/public/img/mailing/encabezado_logo.png" alt="Mundo Maqu" width="600" style="display: block; border: 0;" />
									</td>
								</tr>
							</table>
							
							<!-- CUERPO DEL MENSAJE -->
							<table style="background-color: #ffffff;" width="550" cellspacing="0" cellpadding="0" border="0">
								<tbody>
									<tr>
										<td width="500">
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-top: 0; margin-bottom: 10px; padding:0px 40px 0px;">¡Hola , <span style="color:#301B64;font-weight: bold;">'.$nombres . ' ' .$apellidos.'</span>! <br><br>Han pasado unos días desde que te compartí el contacto de '.$nombresContacto.', y quería saber si tuvieron oportunidad de conversar.<br/>Si aún no logran conectar, feliz de ayudarte a gestionarlo o volver a coordinar.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si tienes consultas, no dudes en contactarnos.</p>
                                            <p style="text-align: left;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 50px; padding:0px 40px 0px;">Saludos,<br><strong>El equipo de Maqu</strong></p>
										</td>
									</tr>
								</tbody>
							</table>
							
							<!-- FOOTER -->
							<br>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: left;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
									<td style="padding: 0 8px; font-size: 14px; line-height: 50px; font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; color: #333333; text-align: center;" align="-">
										<img alt="Canal Cliente: siempre a su servicio" src="https://mundomaqu.com/public/img/mailing/auricular.png" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="50" height="50" border="0">
									</td>
									<td align="right" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: right;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
								</tr>
							</table>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>E-mail</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Atención al Cliente</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Whatsapp</p>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center; border-right: 0px solid #979797" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/correo.png" style="display: inline-block;" width="42" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;border-left: solid 1px;border-right: solid 1px;" >
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/llamada.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/wsp.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="mailto:info@maqu.pe" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">info@maqu.pe</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="tel:51904497062" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">+51 904 497 062</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="https://wa.link/k1rwcp" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">¡Escríbenos!</span></a>
									</td>
								</tr>
							</table>
							<br><br>
							<table style="border-radius: 0px 0px 45px 45px;" width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
								<tbody>
									<tr>
										<td width="600">
											<p style="text-align: center; font-size: 16px;font-family: Lexend, Arial;color: #301B64; margin-top: 20px;">El marketplace de maquinaria pesada</p>
											<p style="text-align: center;font-size: 12px;font-family: Lexend, Arial;color: #301B64;margin-bottom: 5px;">S&iacute;guenos en redes sociales</p>
										</td>
									</tr>
									<tr>
										<td width="600">
											<p style="text-align: center;font-size: 12px;font-family:Lexend, Arial;color: #606060;">
												<a href="https://www.facebook.com/mundomaqu" style="color:#301B64">Facebook</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.instagram.com/mundo.maqu/" style="color:#301B64">Instagram</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.tiktok.com/@maquoficial" style="color:#301B64">Tiktok</a></p>
										</td>
									</tr>
								</tbody>
							</table>
							<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
								<tbody>
									<tr>
										<td width="550">
											<p style="color: #301B64;text-align: center;font-size: 10px;font-family: Lexend, Arial;padding-bottom: 10px; padding-top: 15px;"> 
												Copyright © 2024 Ricardo Barcena, All rights reserved
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</html>
        ';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        $email->send();
    }

    /* CORREO SEGUIMIENTO DE CONTACTO (1 DIA) */
    public function correoSeguimientoContactoUnDia($nombresContacto, $nombres, $apellidos, $correoElectronico){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        //$to = 'backoffice@maqu.pe';
        $subject = 'Seguimiento – ¿Pudiste ponerte en contacto con '.$nombresContacto.'?';
        $message = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
					<meta name="viewport" content="width=480, user-scalable=1" />
					<title>Mundo Maqu</title>
					<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
				</head>
				<body style="margin: 0; padding: 0; background-color:#F4F4F4">
					<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F4F4F4">
					<tr>
						<td align="center">
							<!-- ENCABEZADO - LOGO -->
							<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
								<tr>
									<td>
										<img src="https://mundomaqu.com/public/img/mailing/encabezado_logo.png" alt="Mundo Maqu" width="600" style="display: block; border: 0;" />
									</td>
								</tr>
							</table>
							
							<!-- CUERPO DEL MENSAJE -->
							<table style="background-color: #ffffff;" width="550" cellspacing="0" cellpadding="0" border="0">
								<tbody>
									<tr>
										<td width="500">
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-top: 0; margin-bottom: 10px; padding:0px 40px 0px;">¡Hola , <span style="color:#301B64;font-weight: bold;">'.$nombres . ' ' .$apellidos.'</span>! <br><br>Solo quería hacer un breve seguimiento para saber si lograste ponerte en contacto con '.$nombresContacto.' respecto a la propuesta.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si tienes consultas, no dudes en contactarnos.</p>
                                            <p style="text-align: left;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 50px; padding:0px 40px 0px;">Saludos,<br><strong>El equipo de Maqu</strong></p>
										</td>
									</tr>
								</tbody>
							</table>
							
							<!-- FOOTER -->
							<br>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: left;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
									<td style="padding: 0 8px; font-size: 14px; line-height: 50px; font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; color: #333333; text-align: center;" align="-">
										<img alt="Canal Cliente: siempre a su servicio" src="https://mundomaqu.com/public/img/mailing/auricular.png" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="50" height="50" border="0">
									</td>
									<td align="right" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: right;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
								</tr>
							</table>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>E-mail</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Atención al Cliente</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Whatsapp</p>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center; border-right: 0px solid #979797" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/correo.png" style="display: inline-block;" width="42" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;border-left: solid 1px;border-right: solid 1px;" >
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/llamada.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/wsp.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="mailto:info@maqu.pe" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">info@maqu.pe</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="tel:51904497062" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">+51 904 497 062</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="https://wa.link/k1rwcp" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">¡Escríbenos!</span></a>
									</td>
								</tr>
							</table>
							<br><br>
							<table style="border-radius: 0px 0px 45px 45px;" width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
								<tbody>
									<tr>
										<td width="600">
											<p style="text-align: center; font-size: 16px;font-family: Lexend, Arial;color: #301B64; margin-top: 20px;">El marketplace de maquinaria pesada</p>
											<p style="text-align: center;font-size: 12px;font-family: Lexend, Arial;color: #301B64;margin-bottom: 5px;">S&iacute;guenos en redes sociales</p>
										</td>
									</tr>
									<tr>
										<td width="600">
											<p style="text-align: center;font-size: 12px;font-family:Lexend, Arial;color: #606060;">
												<a href="https://www.facebook.com/mundomaqu" style="color:#301B64">Facebook</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.instagram.com/mundo.maqu/" style="color:#301B64">Instagram</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.tiktok.com/@maquoficial" style="color:#301B64">Tiktok</a></p>
										</td>
									</tr>
								</tbody>
							</table>
							<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
								<tbody>
									<tr>
										<td width="550">
											<p style="color: #301B64;text-align: center;font-size: 10px;font-family: Lexend, Arial;padding-bottom: 10px; padding-top: 15px;"> 
												Copyright © 2024 Ricardo Barcena, All rights reserved
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</html>
        ';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        $email->send();
    }

    /* CORREO DE RECORDATORIO DE VISITA */
    public function correoRecordatorioAgendaVisita($nombres, $apellidos, $correoElectronico, $fecha, $direccion, $anuncio){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        //$to = 'backoffice@maqu.pe';
        $subject = '⏰ Recordatorio: Tienes una visita agendada para mañana con MAQU';
        $message = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
					<meta name="viewport" content="width=480, user-scalable=1" />
					<title>Mundo Maqu</title>
					<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
				</head>
				<body style="margin: 0; padding: 0; background-color:#F4F4F4">
					<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F4F4F4">
					<tr>
						<td align="center">
							<!-- ENCABEZADO - LOGO -->
							<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
								<tr>
									<td>
										<img src="https://mundomaqu.com/public/img/mailing/encabezado_logo.png" alt="Mundo Maqu" width="600" style="display: block; border: 0;" />
									</td>
								</tr>
							</table>
							
							<!-- CUERPO DEL MENSAJE -->
							<table style="background-color: #ffffff;" width="550" cellspacing="0" cellpadding="0" border="0">
								<tbody>
									<tr>
										<td width="500">
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-top: 0; margin-bottom: 10px; padding:0px 40px 0px;">¡Hola , <span style="color:#301B64;font-weight: bold;">'.$nombres . ' ' .$apellidos.'</span>! <br><br>Este es un recordatorio de que tu visita está programada para mañana. Aquí te dejamos los detalles para que los tengas a la mano:</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">
												🟨 Equipo a visitar: '.$anuncio.'<br/>
												📅 Fecha: '.date("d-m-Y", strtotime($fecha)).'<br/>
												🕒 Hora: '.date("H:i", strtotime($fecha)).'
											</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">🔎 Recomendaciones:</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Puedes venir con tu técnico o acompañante.</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Nuestro equipo estará presente para mostrarte el estado de la máquina.</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si necesitas reprogramar, avísanos con anticipación.</p>
											<p style="text-align: justify;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">📲 ¿Tienes dudas? Escríbenos al WhatsApp +51 904 497 062</p>
											<p style="text-align: left;font-size: 14px;font-family: Lexend, Arial;color: #0f0f4d;margin-bottom: 50px; padding:0px 40px 0px;">Gracias por confiar en MAQU,<br><strong>Nos vemos pronto<br/>El equipo de mundomaqu.com</strong></p>
										</td>
									</tr>
								</tbody>
							</table>
							
							<!-- FOOTER -->
							<br>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: left;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
									<td style="padding: 0 8px; font-size: 14px; line-height: 50px; font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; color: #333333; text-align: center;" align="-">
										<img alt="Canal Cliente: siempre a su servicio" src="https://mundomaqu.com/public/img/mailing/auricular.png" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="50" height="50" border="0">
									</td>
									<td align="right" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: right;">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0">
										<img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
									</td>
								</tr>
							</table>
							<table width="550" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>E-mail</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Atención al Cliente</p>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<p>Whatsapp</p>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center; border-right: 0px solid #979797" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/correo.png" style="display: inline-block;" width="42" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;border-left: solid 1px;border-right: solid 1px;" >
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/llamada.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
									<td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;" width="33.333%" align="center">
										<img alt="•" src="https://mundomaqu.com/public/img/mailing/wsp.png" style="display: inline-block;" width="45" height="42" border="0">
									</td>
								</tr>
								<tr>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="mailto:info@maqu.pe" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">info@maqu.pe</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="tel:51904497062" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">+51 904 497 062</span></a>
									</td>
									<td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
										<a href="https://wa.link/k1rwcp" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">¡Escríbenos!</span></a>
									</td>
								</tr>
							</table>
							<br><br>
							<table style="border-radius: 0px 0px 45px 45px;" width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
								<tbody>
									<tr>
										<td width="600">
											<p style="text-align: center; font-size: 16px;font-family: Lexend, Arial;color: #301B64; margin-top: 20px;">El marketplace de maquinaria pesada</p>
											<p style="text-align: center;font-size: 12px;font-family: Lexend, Arial;color: #301B64;margin-bottom: 5px;">S&iacute;guenos en redes sociales</p>
										</td>
									</tr>
									<tr>
										<td width="600">
											<p style="text-align: center;font-size: 12px;font-family:Lexend, Arial;color: #606060;">
												<a href="https://www.facebook.com/mundomaqu" style="color:#301B64">Facebook</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.instagram.com/mundo.maqu/" style="color:#301B64">Instagram</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
												<a href="https://www.tiktok.com/@maquoficial" style="color:#301B64">Tiktok</a></p>
										</td>
									</tr>
								</tbody>
							</table>
							<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
								<tbody>
									<tr>
										<td width="550">
											<p style="color: #301B64;text-align: center;font-size: 10px;font-family: Lexend, Arial;padding-bottom: 10px; padding-top: 15px;"> 
												Copyright © 2024 Ricardo Barcena, All rights reserved
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</html>
        ';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        $email->send();
    }

    /* CORREO # 10 */
    public function correoVencimientoAnuncioUnDia($nombres, $apellidos, $correoElectronico, $nombreAnuncio){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        //$to = 'backoffice@maqu.pe';
        $subject = '¡Tu anuncio vence mañana!';
        $message = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
                    <meta name="viewport" content="width=480, user-scalable=1" />
                    <title>Mundo Maqu</title>
                    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
                </head>
                <body style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; background-color:#F4F4F4">
                    <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F4F4F4">
                    <tr>
                        <td align="center">
                            <!-- CREATIVIDAD -->
                            <table width="600" height="0" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="600">
                                        <img src="https://mundomaqu.com/public/img/mailing/encabezado_logo.png" alt="Mundo Maqu" width="600"  border="0" style="display:block; padding:0; border:0" />
                                    </td>
                                </tr>
                            </table>
                            <!--<table width="600" height="0" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="600"><img src="https://mundomaqu.com/public/img/mailing/banner.png" alt="" width="600"  border="0" style="display:block; padding:0; border:0" /></td>
                                </tr>
                            </table>-->
                            <!-- AQUI VA EL MENSAJE -->
                            <table style="background-color: #ffffff;" width="550" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td width="500">
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">¡Hola , <span style="color:#301B64;font-weight: bold;">'.$nombres . ' ' .$apellidos.'</span>! <br><br>Este es un recordatorio de que tu anuncio '.$nombreAnuncio.' vencerá mañana.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si aún deseas que tu maquinaria o repuesto continúe visible para posibles compradores, te recomendamos renovarlo cuanto antes. No te preocupes, es fácil de hacer y solo te tomará unos minutos.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Renueva tu anuncio ahora iniciando sesión e ingresando a la sección Mis anuncios.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si necesitas asistencia, no dudes en contactarnos.</p>
                                            <p style="text-align: left;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 50px; padding:0px 40px 0px;">Saludos,<br><strong>El equipo de Maqu</strong></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- FIN MENSAJE -->
                            <br>
                            <table width="550" height="0"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: left;">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                    </td>
                                    <td style="padding: 0 8px; font-size: 14px; line-height: 50px; font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; color: #333333; text-align: center;" align="-">
                                        <img alt="Canal Cliente: siempre a su servicio" src="https://mundomaqu.com/public/img/mailing/auricular.png" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="50" height="50" border="0">
                                    </td>
                                    <td align="right" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: right;">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                    </td>
                                </tr>
                            </table>
                            <table width="550" height="0"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p >E-mail</p>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p >Atención al Cliente</p>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p>Whatsapp</p>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center; border-right: 0px solid #979797" width="33.333%" align="center">
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/correo.png" style="display: inline-block;" width="42" height="42" border="0">
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;border-left: solid 1px;border-right: solid 1px;" >
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/llamada.png" style="display: inline-block;" width="45" height="42" border="0">
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;" width="33.333%" align="center">
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/wsp.png" style="display: inline-block;" width="45" height="42" border="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="mailto:info@maqu.pe" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">info@maqu.pe</span></a>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="tel:51904497062" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">+51 904 497 062</span></a>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="https://wa.link/k1rwcp" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">¡Escríbenos!</span></a>
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <table style="border-radius: 0px 0px 45px 45px;" width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                <tbody>
                                    <tr>
                                        <td width="600">
                                            <p style="text-align: center;  font-size: 16px;font-family:  Lexend, Arial;color: #301B64; margin-top: 20px;">El marketplace de maquinaria pesada</p>
                                            <p style="text-align: center;font-size: 12px;font-family:  Lexend, Arial;color: #301B64;margin-bottom: 5px;">S&iacute;guenos en redes sociales</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="600">
                                            <p style="text-align: center;font-size: 12px;font-family:Lexend, Arial;color: #606060;">
                                                <a href="https://www.facebook.com/mundomaqu" style="color:#301B64">Facebook</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <a href="https://www.instagram.com/mundo.maqu/" style="color:#301B64">Instagram</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <a href="https://www.tiktok.com/@maquoficial" style="color:#301B64">Tiktok</a></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
                                <tbody>
                                    <tr>
                                        <td width="550">
                                            <p style="color: #301B64;text-align: center;font-size: 10px;font-family:  Lexend, Arial;padding-bottom: 10px; padding-top: 15px;"> 
                                                Copyright © 2024 Ricardo Barcena, All rights reserved
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </html>
        ';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        //$email->send();
        if (!$email->send(false)) {
            // Si falla el envío, mostrar los errores
            //echo $email->printDebugger(['headers', 'subject', 'body']);
        } else {
            //echo 'Email enviado con éxito.';
        }
    }

    /* CORREO # 11 */
    public function correoVencimientoAnuncioHaceUnDia($nombres, $apellidos, $correoElectronico, $nombreAnuncio){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        //$to = 'backoffice@maqu.pe';
        $subject = 'Tu anuncio ha vencido, ¡renuévalo para seguir en MAQU!';
        $message = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
                    <meta name="viewport" content="width=480, user-scalable=1" />
                    <title>Mundo Maqu</title>
                    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
                </head>
                <body style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; background-color:#F4F4F4">
                    <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F4F4F4">
                    <tr>
                        <td align="center">
                            <!-- CREATIVIDAD -->
                            <table width="600" height="0" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="600">
                                        <img src="https://mundomaqu.com/public/img/mailing/encabezado_logo.png" alt="Mundo Maqu" width="600"  border="0" style="display:block; padding:0; border:0" />
                                    </td>
                                </tr>
                            </table>
                            <!--<table width="600" height="0" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="600"><img src="https://mundomaqu.com/public/img/mailing/banner.png" alt="" width="600"  border="0" style="display:block; padding:0; border:0" /></td>
                                </tr>
                            </table>-->
                            <!-- AQUI VA EL MENSAJE -->
                            <table style="background-color: #ffffff;" width="550" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td width="500">
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">¡Hola , <span style="color:#301B64;font-weight: bold;">'.$nombres . ' ' .$apellidos.'</span>! <br><br>Queremos informarte que tu anuncio '.$nombreAnuncio.' ha vencido.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si tu maquinaria o repuesto sigue disponible, te invitamos a renovarlo para que vuelva a estar visible en MAQU y puedas continuar recibiendo consultas de compradores interesados.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Renueva tu anuncio ahora iniciando sesión e ingresando a la sección Mis anuncios.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si ya has concretado una venta o alquiler, ¡felicitaciones! Si no, estamos aquí para ayudarte a seguir impulsando tu anuncio.</p>
                                            <p style="text-align: left;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 50px; padding:0px 40px 0px;">Saludos,<br><strong>El equipo de Maqu</strong></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- FIN MENSAJE -->
                            <br>
                            <table width="550" height="0"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: left;">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                    </td>
                                    <td style="padding: 0 8px; font-size: 14px; line-height: 50px; font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; color: #333333; text-align: center;" align="-">
                                        <img alt="Canal Cliente: siempre a su servicio" src="https://mundomaqu.com/public/img/mailing/auricular.png" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="50" height="50" border="0">
                                    </td>
                                    <td align="right" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: right;">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                    </td>
                                </tr>
                            </table>
                            <table width="550" height="0"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p >E-mail</p>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p >Atención al Cliente</p>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p>Whatsapp</p>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center; border-right: 0px solid #979797" width="33.333%" align="center">
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/correo.png" style="display: inline-block;" width="42" height="42" border="0">
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;border-left: solid 1px;border-right: solid 1px;" >
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/llamada.png" style="display: inline-block;" width="45" height="42" border="0">
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;" width="33.333%" align="center">
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/wsp.png" style="display: inline-block;" width="45" height="42" border="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="mailto:info@maqu.pe" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">info@maqu.pe</span></a>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="tel:51904497062" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">+51 904 497 062</span></a>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="https://wa.link/k1rwcp" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">¡Escríbenos!</span></a>
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <table style="border-radius: 0px 0px 45px 45px;" width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                <tbody>
                                    <tr>
                                        <td width="600">
                                            <p style="text-align: center;  font-size: 16px;font-family:  Lexend, Arial;color: #301B64; margin-top: 20px;">El marketplace de maquinaria pesada</p>
                                            <p style="text-align: center;font-size: 12px;font-family:  Lexend, Arial;color: #301B64;margin-bottom: 5px;">S&iacute;guenos en redes sociales</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="600">
                                            <p style="text-align: center;font-size: 12px;font-family:Lexend, Arial;color: #606060;">
                                                <a href="https://www.facebook.com/mundomaqu" style="color:#301B64">Facebook</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <a href="https://www.instagram.com/mundo.maqu/" style="color:#301B64">Instagram</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <a href="https://www.tiktok.com/@maquoficial" style="color:#301B64">Tiktok</a></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
                                <tbody>
                                    <tr>
                                        <td width="550">
                                            <p style="color: #301B64;text-align: center;font-size: 10px;font-family:  Lexend, Arial;padding-bottom: 10px; padding-top: 15px;"> 
                                                Copyright © 2024 Ricardo Barcena, All rights reserved
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </html>
        ';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        //$email->send();
        if (!$email->send(false)) {
            // Si falla el envío, mostrar los errores
            //echo $email->printDebugger(['headers', 'subject', 'body']);
        } else {
            //echo 'Email enviado con éxito.';
        }
    }

    /* CORREO # 13 */
    public function correoVencimientoAnuncioMasDiezDias($nombres, $apellidos, $correoElectronico, $nombreAnuncio){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        //$to = 'backoffice@maqu.pe';
        $subject = '¡Tu anuncio ha vencido hace más de 10 días! Publica gratis en MAQU';
        $message = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
                    <meta name="viewport" content="width=480, user-scalable=1" />
                    <title>Mundo Maqu</title>
                    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
                </head>
                <body style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; background-color:#F4F4F4">
                    <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F4F4F4">
                    <tr>
                        <td align="center">
                            <!-- CREATIVIDAD -->
                            <table width="600" height="0" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="600">
                                        <img src="https://mundomaqu.com/public/img/mailing/encabezado_logo.png" alt="Mundo Maqu" width="600"  border="0" style="display:block; padding:0; border:0" />
                                    </td>
                                </tr>
                            </table>
                            <!--<table width="600" height="0" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="600"><img src="https://mundomaqu.com/public/img/mailing/banner.png" alt="" width="600"  border="0" style="display:block; padding:0; border:0" /></td>
                                </tr>
                            </table>-->
                            <!-- AQUI VA EL MENSAJE -->
                            <table style="background-color: #ffffff;" width="550" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td width="500">
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">¡Hola , <span style="color:#301B64;font-weight: bold;">'.$nombres . ' ' .$apellidos.'</span>! <br><br>Notamos que tu anuncio '.$nombreAnuncio.' ha estado vencido por más de 10 días. Si tu maquinaria o repuesto sigue disponible, ¡tenemos buenas noticias para ti!</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Puedes publicar tu anuncio de nuevo completamente gratis en MAQU. Aprovecha esta oportunidad para que tu equipo llegue a más compradores interesados.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">¿Cómo hacerlo?</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Inicia sesión en tu cuenta.<br/>
                                                Dirígete a la sección "Publicar anuncio".<br/>
                                                Completa la información y publícalo en pocos pasos.<br/>
                                                Además, si deseas crear nuevos anuncios, ¡también es una excelente opción! No dudes en explorar todas las posibilidades que ofrecemos.
                                            </p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si necesitas ayuda o tienes alguna pregunta, no dudes en contactarnos. Estamos aquí para apoyarte en cada paso.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">¡Esperamos verte de nuevo en MAQU!</p>
                                            <p style="text-align: left;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 50px; padding:0px 40px 0px;">Saludos,<br><strong>El equipo de Maqu</strong></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- FIN MENSAJE -->
                            <br>
                            <table width="550" height="0"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: left;">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                    </td>
                                    <td style="padding: 0 8px; font-size: 14px; line-height: 50px; font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; color: #333333; text-align: center;" align="-">
                                        <img alt="Canal Cliente: siempre a su servicio" src="https://mundomaqu.com/public/img/mailing/auricular.png" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="50" height="50" border="0">
                                    </td>
                                    <td align="right" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: right;">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                    </td>
                                </tr>
                            </table>
                            <table width="550" height="0"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p >E-mail</p>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p >Atención al Cliente</p>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p>Whatsapp</p>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center; border-right: 0px solid #979797" width="33.333%" align="center">
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/correo.png" style="display: inline-block;" width="42" height="42" border="0">
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;border-left: solid 1px;border-right: solid 1px;" >
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/llamada.png" style="display: inline-block;" width="45" height="42" border="0">
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;" width="33.333%" align="center">
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/wsp.png" style="display: inline-block;" width="45" height="42" border="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="mailto:info@maqu.pe" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">info@maqu.pe</span></a>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="tel:51904497062" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">+51 904 497 062</span></a>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="https://wa.link/k1rwcp" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">¡Escríbenos!</span></a>
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <table style="border-radius: 0px 0px 45px 45px;" width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                <tbody>
                                    <tr>
                                        <td width="600">
                                            <p style="text-align: center;  font-size: 16px;font-family:  Lexend, Arial;color: #301B64; margin-top: 20px;">El marketplace de maquinaria pesada</p>
                                            <p style="text-align: center;font-size: 12px;font-family:  Lexend, Arial;color: #301B64;margin-bottom: 5px;">S&iacute;guenos en redes sociales</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="600">
                                            <p style="text-align: center;font-size: 12px;font-family:Lexend, Arial;color: #606060;">
                                                <a href="https://www.facebook.com/mundomaqu" style="color:#301B64">Facebook</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <a href="https://www.instagram.com/mundo.maqu/" style="color:#301B64">Instagram</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <a href="https://www.tiktok.com/@maquoficial" style="color:#301B64">Tiktok</a></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
                                <tbody>
                                    <tr>
                                        <td width="550">
                                            <p style="color: #301B64;text-align: center;font-size: 10px;font-family:  Lexend, Arial;padding-bottom: 10px; padding-top: 15px;"> 
                                                Copyright © 2024 Ricardo Barcena, All rights reserved
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </html>
        ';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        //$email->send();
        if (!$email->send(false)) {
            // Si falla el envío, mostrar los errores
            //echo $email->printDebugger(['headers', 'subject', 'body']);
        } else {
            //echo 'Email enviado con éxito.';
        }
    }

    /* FIN CRON */

    public function correoEnvioCodigo($token, $correoElectronico){
        $to = $correoElectronico;
        $subject = 'Código de validación de acceso '. date("d-m-Y H:i:s");
        $message = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
                <meta name="viewport" content="width=480, user-scalable=1" />
                <title>Mundo Maqu</title>
                <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,700" rel="stylesheet">
            </head>
            <body style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; background-color:#F4F4F4">
                <p>Token de acceso: '.$token.'</p>
                <p>Correo electrónico: '.$correoElectronico.'</p>
                <p>Fecha y hora de solicitud: '.date("d-m-Y H:i:s").'</p>
            </body>
        </html>';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        $email->send();
        //if (!$email->send(false)) {
            // Si falla el envío, mostrar los errores
            //echo $email->printDebugger(['headers', 'subject', 'body']); exit;
        //} else {
            //echo 'Email enviado con éxito.'; exit;
        //}
    }

    public function correoAnuncioAprobado($nombres, $apellidos, $nombreAnuncio, $tipoAnuncio, $correoElectronico, $idProducto, $link){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        $subject = '¡Tu anuncio ha sido aprobado y ya está publicado!';
        
        $html_file_path = $this->items['basePath'] . '7.html';
        
        // Leer el contenido del archivo HTML
        $message = file_get_contents($html_file_path);
    
        // Reemplazar los marcadores de posición en el HTML por los valores dinámicos
        $message = str_replace('{{nombres}}', $nombres, $message);
        $message = str_replace('{{apellidos}}', $apellidos, $message);
        $message = str_replace('{{nombreAnuncio}}', $nombreAnuncio, $message);
        $message = str_replace('{{idProducto}}', $idProducto, $message);
        $message = str_replace('{{link}}', $link, $message);
        $message = str_replace('{{tipoAnuncio}}', $tipoAnuncio, $message);
        
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        //$email->send();
        if (!$email->send(false)) {
            // Si falla el envío, mostrar los errores
            //echo $email->printDebugger(['headers', 'subject', 'body']);
        } else {
            //echo 'Email enviado con éxito.';
        }
    }

    public function correoAnuncioRechazado($nombres, $apellidos, $nombreAnuncio, $correoElectronico, $motivoRechazo){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        $subject = 'Necesitamos que corrijas algunos detalles en tu anuncio';
        
        $html_file_path = $this->items['basePath'] . '8.html';
        
        // Leer el contenido del archivo HTML
        $message = file_get_contents($html_file_path);
    
        // Reemplazar los marcadores de posición en el HTML por los valores dinámicos
        $message = str_replace('{{nombres}}', $nombres, $message);
        $message = str_replace('{{apellidos}}', $apellidos, $message);
        $message = str_replace('{{nombreAnuncio}}', $nombreAnuncio, $message);
        $message = str_replace('{{motivoRechazo}}', $motivoRechazo, $message);
        
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('ricardo.barcena@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        //$email->send();
        if (!$email->send(false)) {
            // Si falla el envío, mostrar los errores
            //echo $email->printDebugger(['headers', 'subject', 'body']);
        } else {
            //echo 'Email enviado con éxito.';
        }
    }

    public function correoSolicitudInspeccion($nombres, $apellidos, $nombreAnuncio, $correoElectronico, $idProducto, $link){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        $subject = '¡Tu anuncio ha sido verificado!';
        
        $html_file_path = $this->items['basePath'] . '22.html';
        
        // Leer el contenido del archivo HTML
        $message = file_get_contents($html_file_path);
    
        // Reemplazar los marcadores de posición en el HTML por los valores dinámicos
        $message = str_replace('{{nombres}}', $nombres, $message);
        $message = str_replace('{{apellidos}}', $apellidos, $message);
        $message = str_replace('{{nombreAnuncio}}', $nombreAnuncio, $message);
        $message = str_replace('{{idProducto}}', $idProducto, $message);
        $message = str_replace('{{link}}', $link, $message);
        
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        //$email->send();
        if (!$email->send(false)) {
            // Si falla el envío, mostrar los errores
            //echo $email->printDebugger(['headers', 'subject', 'body']);
        } else {
            //echo 'Email enviado con éxito.';
        }
    }

    public function correoIntentoContacto($nombres, $correoElectronico, $nombreAnuncio){
        $to = $correoElectronico . ', backoffice@maqu.pe';
        $subject = '¿Sigues interesado en ' . $nombreAnuncio . '?';
        $message = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
                    <meta name="viewport" content="width=480, user-scalable=1" />
                    <title>Mundo Maqu</title>
                    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
                </head>
                <body style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; background-color:#F4F4F4">
                    <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F4F4F4">
                    <tr>
                        <td align="center">
                            <!-- CREATIVIDAD -->
                            <table width="600" height="0" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="600">
                                        <img src="https://mundomaqu.com/public/img/mailing/encabezado_logo.png" alt="Mundo Maqu" width="600"  border="0" style="display:block; padding:0; border:0" />
                                    </td>
                                </tr>
                            </table>
                            <!--<table width="600" height="0" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="600"><img src="https://mundomaqu.com/public/img/mailing/banner.png" alt="" width="600"  border="0" style="display:block; padding:0; border:0" /></td>
                                </tr>
                            </table>-->
                            <!-- AQUI VA EL MENSAJE -->
                            <table style="background-color: #ffffff;" width="550" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td width="500">
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Hola '. $nombres . '</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Intentamos contactarte respecto a '.$nombreAnuncio.' que viste en nuestra plataforma, pero no hemos recibido respuesta.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Si aún estás interesado, avísanos para brindarte más información o coordinar una visita. También podemos ayudarte a encontrar otras opciones que se ajusten a lo que buscas.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Puedes escribirnos directamente al +51 904 497 062 para atenderte más rápido.</p>
                                            <p style="text-align: justify;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 10px; padding:0px 40px 0px;">Esperamos tu confirmación. ¡Quedamos atentos!</p>
                                            <p style="text-align: left;font-size: 14px;font-family:  Lexend, Arial;color: #0f0f4d;margin-bottom: 50px; padding:0px 40px 0px;">Saludos,<br><strong>El equipo de Maqu</strong></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- FIN MENSAJE -->
                            <br>
                            <table width="550" height="0"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: left;">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                    </td>
                                    <td style="padding: 0 8px; font-size: 14px; line-height: 50px; font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; color: #333333; text-align: center;" align="-">
                                        <img alt="Canal Cliente: siempre a su servicio" src="https://mundomaqu.com/public/img/mailing/auricular.png" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="50" height="50" border="0">
                                    </td>
                                    <td align="right" style="font-size: 14px; line-height: 1px; font-family: Lexend, sans-serif; color: #747474; text-align: right;">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0">
                                        <img alt="-------" src="https://mundomaqu.com/public/img/mailing/line_dotted.webp" style="display: block; margin: 0 auto; display: inline-block; max-width: 100%; height: auto;" width="118" height="1" border="0" />
                                    </td>
                                </tr>
                            </table>
                            <table width="550" height="0"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p >E-mail</p>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p >Atención al Cliente</p>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Lexend, Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <p>Whatsapp</p>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center; border-right: 0px solid #979797" width="33.333%" align="center">
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/correo.png" style="display: inline-block;" width="42" height="42" border="0">
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;border-left: solid 1px;border-right: solid 1px;" >
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/llamada.png" style="display: inline-block;" width="45" height="42" border="0">
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; font-size: 14px; line-height: 42px; font-family: Arial, sans-serif; color: #333333; text-align: center;" width="33.333%" align="center">
                                        <img alt="•" src="https://mundomaqu.com/public/img/mailing/wsp.png" style="display: inline-block;" width="45" height="42" border="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="mailto:info@maqu.pe" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">info@maqu.pe</span></a>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="tel:51904497062" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">+51 904 497 062</span></a>
                                    </td>
                                    <td style="padding-left: 5px; padding-right: 5px; padding-top: 16px; font-size: 13px; line-height: 15px; font-family: Arial, sans-serif; color: #0f0f4d; text-align: center;" width="33.333%" align="center">
                                        <a href="https://wa.link/k1rwcp" style="color: #0f0f4d; text-decoration: none; display: block; font-family: Lexend, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif; font-size: 14px;"><span style="font-size: 14px;">¡Escríbenos!</span></a>
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <table style="border-radius: 0px 0px 45px 45px;" width="550" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                <tbody>
                                    <tr>
                                        <td width="600">
                                            <p style="text-align: center;  font-size: 16px;font-family:  Lexend, Arial;color: #301B64; margin-top: 20px;">El marketplace de maquinaria pesada</p>
                                            <p style="text-align: center;font-size: 12px;font-family:  Lexend, Arial;color: #301B64;margin-bottom: 5px;">S&iacute;guenos en redes sociales</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="600">
                                            <p style="text-align: center;font-size: 12px;font-family:Lexend, Arial;color: #606060;">
                                                <a href="https://www.facebook.com/mundomaqu" style="color:#301B64">Facebook</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <a href="https://www.instagram.com/mundo.maqu/" style="color:#301B64">Instagram</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <a href="https://www.tiktok.com/@maquoficial" style="color:#301B64">Tiktok</a></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
                                <tbody>
                                    <tr>
                                        <td width="550">
                                            <p style="color: #301B64;text-align: center;font-size: 10px;font-family:  Lexend, Arial;padding-bottom: 10px; padding-top: 15px;"> 
                                                Copyright © 2024 Ricardo Barcena, All rights reserved
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </html>
        ';
        //$filepath = 'public/assets/files/form_pep.pdf';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('backoffice@maqu.pe','Contacto Maqu');
        $email->setSubject($subject);
        $email->setMessage($message);
        //$email->attach($filepath);
        $email->send();
    }
    
    public function dias_pasados($fecha_inicial,$fecha_final) {
        $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
        $dias = abs($dias); $dias = floor($dias);
        return $dias;
    }

    public function convertirDias($sum) {
        $years = ($sum / 365) ;
        $years = floor($years); 
        $month = ($sum % 365) / 30.5;
        $month = floor($month);
        $days =($sum % 365) % (30.5 * $month);
        // $days = ($sum % 365) % 30.5; // the rest of days

        // Echo all information set
        //echo 'DAYS RECEIVE : '.$sum.' days<br>';
        $tiempo = $years.' años - '.$month.' meses - '.$days.' días';
        return $tiempo;
    }   
    
    public function mail_attachment($para, $copia, $asunto, $mensaje, $archivos) {
        // Recipient 
        $to = $para; 

        // Sender 
        $from = 'hrinformesp@indracompany.com'; 
        $fromName = 'Usuario Genérico Administración de Personal'; 

        // Email subject 
        $subject = $asunto;

        // Attachment file 
        $files = $archivos; 

        // Email body content 
        /*$htmlContent = ' 
            <h3>PHP Email with Attachment by CodexWorld</h3> 
            <p>This email is sent from the PHP script with attachment.</p> 
        ';*/
        $htmlContent = $mensaje;
        
        // Header for sender info 
        $headers = "From: $fromName"." <".$from.">";
        $headers .= "\nCc: ".$copia;    

        // Boundary  
        $semi_rand = md5(time());  
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  

        // Headers for attachment  
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

        // Multipart boundary  
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  

        // Preparing attachment 

        if(count($files) > 0){
            for($i=0;$i<count($files);$i++){
                if(is_file($files[$i])){
                    $message .= "--{$mime_boundary}\n";
                    $fp =    @fopen($files[$i],"rb");
                    $data =  @fread($fp,filesize($files[$i]));
                    @fclose($fp);
                    $data = chunk_split(base64_encode($data));
                    $message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
                    "Content-Description: ".basename($files[$i])."\n" .
                    "Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
                    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                }
            }                
        } 
        $message .= "--{$mime_boundary}--"; 
        $returnpath = "-f" . $from; 

        // Send email 
        $mail = mail($to, $subject, $message, $headers, $returnpath);  

        // Email sending status 
        //echo $mail?var_dump("Email Sent Successfully!</h1>"):var_dump("Email Sent failed!</h1>");
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

    public function scriptVistaGeneral() {
        /*
         * ----------------------------
         * CONFIGURACION DE INSTALACIÓN
         * ----------------------------
         */
        $obtieneConfiguracion = $this->ci->m_configuracion->mostrarDatos(array('interna' => 'instalacion'));
        $valores = json_decode($obtieneConfiguracion[0]->atributos);
        $this->items['insIntentoError'] = (isset($valores->intentoError)) ? $valores->intentoError : 3;
        $this->items['insTiempoBloqueo'] = (isset($valores->tiempoBloqueo)) ? $valores->tiempoBloqueo : 1;
        $this->items['insDuracionCaptcha'] = (isset($valores->duracionCaptcha)) ? $valores->duracionCaptcha : 240;
        $this->items['insClaveMaestra'] = (isset($valores->claveMaestra)) ? $valores->claveMaestra : 'lacaldas';
        $this->items['insEncriptacionSesion'] = (isset($valores->encriptacionSesion)) ? $valores->encriptacionSesion : '83fdfdc18845e48d5fe3b0ee4073418f';
        $this->items['insFtpActivo'] = (isset($valores->ftpActivo)) ? $valores->ftpActivo : FALSE;
        $this->items['insFtpDireccion'] = (isset($valores->ftpDireccion)) ? $valores->ftpDireccion : 'ftp.aplicacioneswebs.com';
        $this->items['insFtpUbicacion'] = (isset($valores->ftpUbicacion)) ? $valores->ftpUbicacion : 'sub';
        $this->items['insFtpUsuario'] = (isset($valores->ftpUsuario)) ? $valores->ftpUsuario : 'katylor';
        $this->items['insFtpClave'] = (isset($valores->ftpClave)) ? $valores->ftpClave : 'shinomegami1';
        $this->items['insFtpPuerto'] = (isset($valores->ftpPuerto)) ? $valores->ftpPuerto : 21;
        /*
         * ---------------------------------
         * CONFIGURACION GENERAL DEL SISTEMA
         * ---------------------------------
         */
        $obtieneConfiguracion = $this->ci->m_configuracion->mostrarDatos(array('interna' => 'sistema'));
        $valores = json_decode($obtieneConfiguracion[0]->atributos);
        $this->items['sisInfoTituloEmpresa'] = (isset($valores->sisInfoTituloEmpresa)) ? $valores->sisInfoTituloEmpresa : 'SISTEMA';
        $this->items['sisInfoNombreEmpresa'] = (isset($valores->sisInfoNombreEmpresa)) ? $valores->sisInfoNombreEmpresa : 'SISTEMA';
        $this->items['sisInfoCorreo'] = (isset($valores->sisInfoCorreo)) ? $valores->sisInfoCorreo : 'lacaldas.octubre@gmail.com';
        $this->items['sisInfoDireccion'] = (isset($valores->sisInfoDireccion)) ? $valores->sisInfoDireccion : 'Sin dirección';
        $this->items['sisImagenFondo'] = (isset($valores->sisImagenFondo) && $valores->sisImagenFondo != '') ? $valores->sisImagenFondo : 'sisFondoDefecto.png';
        $this->items['sisFavicon'] = (isset($valores->sisFavicon) && $valores->sisFavicon != '') ? $valores->sisFavicon : 'sisFaviconDefecto.png';
        $this->items['sisLogoPrincipal'] = (isset($valores->sisLogoPrincipal) && $valores->sisLogoPrincipal != '') ? $valores->sisLogoPrincipal : 'sisLogoDefecto.png';
        $this->items['sisMarcaAgua'] = (isset($valores->sisMarcaAgua) && $valores->sisMarcaAgua != '') ? 'public/imagen/logo/' . $valores->sisMarcaAgua : 'public/imagen/logo/sisMarcaAgua.png';
        $this->items['sisPieDePagina'] = (isset($valores->sisPieDePagina)) ? $valores->sisPieDePagina : '(c) Copyright 2016 - José Chipana - Cel. 982462802';
        /*
         * ---------------------------------
         * CONFIGURACION DEFECTO DEL SISTEMA
         * ---------------------------------
         */
        $this->items['proyectoTitulo'] = $this->items['sisInfoTituloEmpresa'];
        $this->items['proyectoNombre'] = $this->items['sisInfoNombreEmpresa'];
        $this->items['proyectoFavicon'] = base_url() . 'crop/35/35/logo-' . $this->items['sisFavicon'];
        $this->items['proyectoLogo'] = base_url() . 'crop/42/42/logo-' . $this->items['sisLogoPrincipal'];
        $this->items['proyectoFondo'] = base_url() . 'public/imagen/logo/' . $this->items['sisImagenFondo'];
        $this->items['proyectoPieDePagina'] = $this->items['sisPieDePagina'];
        /*
         * ------------------------------
         * LISTADO DE IMAGENES DE GALERIA
         * ------------------------------
         */
        $galeriaXml_1 = array();
        $galeriaXml_2 = array();

        /*
         * -----------------------------------
         * RETORNA TODOS LOS VALORES OBTENIDOS
         * -----------------------------------
         */
        return $this->items;
    }

    public function abrirFtp() {
        $config['hostname'] = $this->items['insFtpDireccion'];
        $config['username'] = $this->items['insFtpUsuario'];
        $config['password'] = $this->items['insFtpClave'];
        $config['port'] = $this->items['insFtpPuerto'];
        $config['pasive'] = FALSE;
        $config['debug'] = TRUE;
        $this->ci->ftp->connect($config);
    }

    public function cerrarFtp() {
        $this->ci->ftp->close();
    }

    public function RestarfechasEstadoT($f1, $f2) {
        $strStart = $f1;
        $strEnd = $f2;

        $dteStart = new DateTime($strStart);
        $dteEnd = new DateTime($strEnd);
        $dteDiff = $dteStart->diff($dteEnd);

        $strStart2 = $f1;
        $strEnd2 = $f2;
        $fecha1 = strtotime($strStart2);
        $fecha2 = strtotime($strEnd2);
        $Contadordp = 0;
        for ($fecha1; $fecha1 <= $fecha2; $fecha1 = strtotime('+1 day ' . date('Y-m-d', $fecha1))) {
            if ((strcmp(date('D', $fecha1), 'Sun') != 0) and ( strcmp(date('D', $fecha1), 'Sat') != 0)) {
                $Contadordp = $Contadordp + 1;
            }
        }
        if ($Contadordp == 0) {
            return $Contadordp;
        }

//        return $dteDiff->format("%a días %H h %I min");
//        return $dteDiff->format("%a dias %H h %I min") . "|" . $dteDiff->format("%a|%H|%I");
        return $Contadordp - 1;
    }

    public function array_flatten($array) {
        if (!is_array($array)) {
            return FALSE;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function validarFecha($fecha) {
        if ($fecha != '') {
            return $fecha;
        } else {
            return null;
        }
    }

    public function validarFechaN($fecha) {
        if ($fecha != '' && $fecha != '0000-00-00') {
            return $fecha;
        } else {
            return null;
        }
    }

    public function validarNumero($numero) {
        if ($numero != '') {
            return $numero;
        } else {
            return 0;
        }
    }

}
