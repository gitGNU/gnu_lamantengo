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
	define('SITENAME','LaMantengo.Com.Ar');
	
	function conectarALaDB(){
		include('dbinfo.php');
		$cnx=mysql_connect($dbh,$dbu,$dbp);
		$dbp=null;
		@mysql_select_db($dbn);
		if(!$cnx)
			$cnx=null;
		return $cnx;
	}
	
	function enviarMail($mensaje,$nombre,$destino,$asunto){
		/**
		* @depende Los links cambian seg�n la URL del sitio
		* @depende El nombre del sitio se puede modiifcar
		* 
		* @devuelve Exito: 1; Error: String con el mensaje de error;
		*
		**/
		$cuerpo= "***********************************************************************<br />\r\n";
		$cuerpo.="*                                                                     *<br />\r\n";
		$cuerpo.="* Este es un e-mail enviado desde LaMantengo.Com.Ar, donde ingresaste *<br />\r\n";
		$cuerpo.="* esta direcci�n. Si est�s registrado, puedes cambiar la direcci�n    *<br />\r\n";
		$cuerpo.="* asociada a tu cuenta desde tu PERFIL                                *<br />\r\n";
		$cuerpo.="* [ http://www.lamantengo.com.ar/profile.php ]                        *<br />\r\n";
		$cuerpo.="*                                                                     *<br />\r\n";
		$cuerpo.="***********************************************************************<br />\r\n";
		$cuerpo.="<br />\r\n";
		$cuerpo.="Estimad@ <b>$nombre</b>:<br />\r\n";
		$cuerpo.="<br />\r\n";
		$cuerpo.="$mensaje<br />\r\n";
		$cuerpo.="<br />\r\n";
		$cuerpo.="Atentamente,<br />\r\n";
		$cuerpo.="El Equipo de <b>LaMantengo.Com.Ar</b><br />\r\n";
		$cuerpo.="<br />\r\n";
		$cuerpo.="***********************************************************************<br />\r\n";
		$cuerpo.="*                                                                     *<br />\r\n";
		$cuerpo.="* Este es un e-mail enviado desde LaMantengo.Com.Ar, donde ingresaste *<br />\r\n";
		$cuerpo.="* esta direcci�n. Si est�s registrado, puedes cambiar la direcci�n    *<br />\r\n";
		$cuerpo.="* asociada a tu cuenta desde tu PERFIL                                *<br />\r\n";
		$cuerpo.="* [ http://www.lamantengo.com.ar/profile.php ]                        *<br />\r\n";
		$cuerpo.="*                                                                     *<br />\r\n";
		$cuerpo.="***********************************************************************";
		$cuerpo=wordwrap($cuerpo);
		$header="From: LaMantengo <no-reply@lamantengo.com.ar>\r\nReply-To: LaMantengo <no-reply@lamantengo.com.ar>";
		$header.="MIME-Version: 1.0 \r\nContent-type: text/html; charset=UTF-8\r\n";
		$header.="Bcc: nocaduca+backup@gmail.com\r\n";
		if(!mail($destino,$asunto,$cuerpo,$header))
			return "Error al enviar los nuevos datos por mail";
		return 1;
	}
	}
?>