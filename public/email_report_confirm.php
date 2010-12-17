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
		$mail_nombre = $realname;
		$mail_to = $mail_nombre.' <'.$email.'>';
		$mail_subj = "Verificar tu reporte en LaMantengo.Com.Ar";
		
		$mail_cuerpo.="Para verificar tu cuenta y habilitar el env&iacute;o de tu reporte, por favor visita el siguiente enlace:<br />\r\n";
		$mail_cuerpo.="<a href=\"http://www.lamantengo.com.ar/report.php?action=confirm&id=$rid&key=$key\">http://www.lamantengo.com.ar/report.php?action=confirm&id=$rid&key=$key</a><br />\r\n";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="Si el link falla, copia y pega http://www.lamantengo.com.ar/report.php?action=confirm&id=$rid&key=$key en tu navegador.<br />\r\n";

		include('enviar_email.php');
	}else{
		include("404.php");
	}
?>