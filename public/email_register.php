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
		$mail_subj = "Registro en LaMantengo.Com.Ar";
		
		$mail_cuerpo="Bienvenid@ a LaMantengo.Com.Ar<br />\r\n";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="Para comenzar a usar el servicio, inicia sesi&oacute;n en <a href=\"http://www.lamantengo.com.ar/login.php\">http://www.lamantengo.com.ar/login.php</a>.<br />\r\n";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="Tus datos de login son:<br />\r\n";
		$mail_cuerpo.="Usuario: <b>$username</b><br />\r\n";
		$mail_cuerpo.="Contrase&ntilde;a: <b>$password</b><br />\r\n";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="Podr&aacute; cambiar su contrase&ntilde;a desde su perfil, luego de iniciar sesi&oacute;n.<br />\r\n";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="En caso de olvidar su contrase&ntilde;a, si bien no es posible recuperarla, podr&aacute; generar una nueva ingresando a <a href=\"http://www.lamantengo.com.ar/forgot.php\">http://www.lamantengo.com.ar/forgot.php</a><br />\r\n";
		
		include('enviar_email.php');
	}else{
		include("404.php");
	}
?>