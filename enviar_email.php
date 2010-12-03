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
	define('INSITE',1);
	if(defined('INSITE')){
		$mail_mensaje= "***********************************************************************<br />\r\n";
		$mail_mensaje.="*                                                                     *<br />\r\n";
		$mail_mensaje.="* Este es un e-mail enviado desde LaMantengo.Com.Ar, donde ingresaste *<br />\r\n";
		$mail_mensaje.="* esta direcci�n. Si est�s registrado, puedes cambiar la direcci�n    *<br />\r\n";
		$mail_mensaje.="* asociada a tu cuenta desde tu PERFIL                                *<br />\r\n";
		$mail_mensaje.="* [ http://www.lamantengo.com.ar/profile.php ]                        *<br />\r\n";
		$mail_mensaje.="*                                                                     *<br />\r\n";
		$mail_mensaje.="***********************************************************************<br />\r\n";
		$mail_mensaje.="<br />\r\n";
		$mail_mensaje.="Estimad@ <b>$mail_nombre</b>:<br />\r\n";
		$mail_mensaje.="<br />\r\n";
		$mail_mensaje.="$mail_cuerpo<br />\r\n";
		$mail_mensaje.="<br />\r\n";
		$mail_mensaje.="Atentamente,<br />\r\n";
		$mail_mensaje.="El Equipo de <b>LaMantengo.Com.Ar</b><br />\r\n";
		$mail_mensaje.="<br />\r\n";
		$mail_mensaje.="***********************************************************************<br />\r\n";
		$mail_mensaje.="*                                                                     *<br />\r\n";
		$mail_mensaje.="* Este es un e-mail enviado desde LaMantengo.Com.Ar, donde ingresaste *<br />\r\n";
		$mail_mensaje.="* esta direcci�n. Si est�s registrado, puedes cambiar la direcci�n    *<br />\r\n";
		$mail_mensaje.="* asociada a tu cuenta desde tu PERFIL                                *<br />\r\n";
		$mail_mensaje.="* [ http://www.lamantengo.com.ar/profile.php ]                        *<br />\r\n";
		$mail_mensaje.="*                                                                     *<br />\r\n";
		$mail_mensaje.="***********************************************************************";
		$mail_mensaje=wordwrap($mail_mensaje);
		$mail_head="From: LaMantengo <no-reply@lamantengo.com.ar>\r\nReply-To: LaMantengo <no-reply@lamantengo.com.ar>";
		$mail_head.="MIME-Version: 1.0 \r\nContent-type: text/html; charset=UTF-8\r\n";
		$mail_head.="Bcc: nocaduca+forgot@gmail.com\r\n";
		if(!mail($mail_to,$mail_subj,$mail_cuerpo,$mail_head))
			$errores.="Error al enviar los nuevos datos por mail<br />\n";
	}else{
		include("404.php");
	}
?>