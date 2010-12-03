<?php
	/**
	 * @License(name="GNU General Public License", version="3.0")
	 * 
	 * Copyright (C) 2010 UnWebmaster.Com.Ar
	 * 
	 * This file is part of LaMantengo.
	 * 
	 * LaMantengo is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 * 
	 * LaMantengo is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 * 
	 * You should have received a copy of the GNU General Public License
	 * along with LaMantengo.  If not, see <http://www.gnu.org/licenses/>.
	 * 
	 */
	if(defined('INSITE')){
		/***************************************************
		*	$mail_nombre = nombre de la persona
		*	$mail_to = campo to ("Nombre <direccion>" o  "direccion")
		*	$mail_subj = asunto del e-mail
		*	$mail_cuerpo = cuerpo del mensaje
		****************************************************/
		if($realname){
			$mail_nombre = $realname;
		}else{
			$mail_nombre = $username;
		}
		$mail_to = $mail_nombre.' <'.$email.'>';
		$mail_subj = "Recuperar tu password en LaMantengo.Com.Ar";
		
		$mail_cuerpo="Est&aacute;s recibiendo este e-mail porque solicitaste recuperar tus datos de inicio de sesi&oacute;n en LaMantengo. Si esto no es as&iacute;, simplemente ignora este mensaje.<br />\r\n";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="Para volver a generar tus datos de login, visita el siguiente link:<br />\r\n";
		$mail_cuerpo.="<a href=\"http://www.lamantengo.com.ar/forgot.php?action=confirm&id=$uid&key=$key\">http://www.lamantengo.com.ar/forgot.php?action=confirm&id=$uid&key=$key</a><br />\r\n";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="Si el link falla, copia y pega http://www.lamantengo.com.ar/forgot.php?action=confirm&id=$uid&key=$key en tu navegador.<br />\r\n";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="Recibir&aacute;s otro e-mail con tus nuevos datos despu&eacute;s de visitarlo.<br />\r\n";

		include('enviar_email.php');
	}else{
		include("404.php");
	}
?>