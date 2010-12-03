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
		if($uid){ //Usuario esta loggeado
			$query="SELECT `username`, `email`,`realname` FROM `users` WHERE `uid`='$uid' LIMIT 1;";
			$rs = mysql_query ($query);
			if ($fila = mysql_fetch_object ($rs)){
				$username=$fila->username;
				$email=$fila->email;
				$realname=$fila->realname;
			}
			?>
			<a href="profile.php?sid=<?php echo $sid; ?>" title="Perfil de usuario">Perfil</a> -
			<a href="mylinks.php?sid=<?php echo $sid; ?>" title="Ver todos los links del usuario">Mis links</a> - 
			<a href="logout.php?sid=<?php echo $sid; ?>" title="Cerrar la sesi&oacute;n actual">Salir [<b><?php echo $username; ?></b>]</a>
			<?php
		}else{ //Usuario no esta loggeado
			?><form action="login.php?sid=<?php echo $sid;?>" method="post">
				User: <input type="text" name="user" title="Nombre de usuario" size="8" />
				Password: <input type="password" name="password" title="Contrase&ntilde;a de usuario" size="8" />
				<input type="hidden" name="login" value="1" />
				<input type="submit" id="login" value="Entrar" title="Ingresar al sitio" />
			</form>
			<a href="register.php" title="Registrar una nueva cuenta de usuario">Registrarse</a> - 
			<a href="forgot.php" title="Recuperar contrase&ntilde;a de usuario">Olvid&eacute; mi password</a>
			<?php
		} //FIN if($uid)
	}else{//No esta en el sitio. Link directo
		include("404.php");//Tirar 404
	}
?>