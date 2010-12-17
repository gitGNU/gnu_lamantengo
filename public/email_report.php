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
		$mail_to = $mail_nombre.' <'.$mail_enviar_a.'>';
		$mail_subj = "Reporte de tu link en LaMantengo.Com.Ar";
		
		if($mail_es_usuario)
			$mail_cuerpo = "El usuario $username";
		else
			$mail_cuerpo="El visitante $realname";
		$mail_cuerpo.=" ha reportado tu link <a href=\"http://www.lamantengo.com.ar/view.php?id=$id_link\">http://www.lamantengo.com.ar/view.php?id=$id_link</a>";
		if($mail_destination)
			$mail_cuerpo.=", sugiriendo <b>$mail_destination</b> como nuevo destino";
		$mail_cuerpo.=".<br />\r\n";
		$mail_cuerpo.="Su mensaje fue:<br />\r\n";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="<i>&quot;".$mail_dice."&quot;</i>";
		$mail_cuerpo.="<br />\r\n";
		$mail_cuerpo.="Puedes contactar a $mail_nombre en $mail_enviar_a.<br />\r\n";

		include('enviar_email.php');
	}else{
		include("404.php");
	}
?>