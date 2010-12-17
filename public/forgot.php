<?php
	/**
	 * @License(name="GNU General Public License", version="3.0")
	 * 
	 * Copyright (C) 2010 UnWebmaster.Com.Ar
         * Copyright (C) 2010 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
	$title="Recuperar password";
	require_once("../includes/initialise.php");
	include('get_sid.php');
	$errores="";
	if($uid){ //Ya esta loggeado
		$errores.="El usuario ya est&aacute; loggeado.";
	}else{ //No esta loggeado. Miro si llego data o no
		if($_POST){ //Llego data en POST, osea, ya metio el nombre de usuario/email
			if($_POST['username']==""){
				$errores.="El nombre de usuario est&aacute; vac&iacute;o<br/ >\n";
				$username="";
			}else{
				$username=$_POST['username'];
			}
			if($_POST['email']==""){
				$errores.="El email est&aacute; vac&iacute;a<br/ >\n";
			}else{
				$email=$_POST['email'];
			}
			/************************* chequeo recaptcha **************************************
			include('recaptcha_check.php');
			/**********************fin chequeo recaptcha **************************************/
			if(!($errores)){
				$query="SELECT uid,username,email,realname,active FROM users WHERE LOWER(username) ='".strtolower($username)."' AND email='".strtolower($email)."'";
				$rs = mysql_query ($query);
				if ($fila = mysql_fetch_object ($rs)){ //matchean user y mail... genero nuevo pass, y lo mando
					if(!$fila->active){
						$errores.="El usuario fue desactivado por la administraci&oacute;n<br />\n";
						$_POST['email']="";
						$_POST['username']="";
					}else{
						$uid=$fila->uid;
						$username=$fila->username;
						$email=$fila->email;
						$realname=$fila->realname;
						include("generar_password.php");
						$password=generar_pass();
						include("email_forgot.php");
						$password=md5($password);
						$query = "UPDATE `users` SET `password`='$password' WHERE `uid`=$uid;";
						$password="";
						$rs=mysql_query($query);
						if($errores)
							$success=$cuerpo;
						else
							$success="Su password fue actualizado correctamente. Revise su email (<b>$email</b>) para obtener sus nuevos datos de ingreso.";
						$uid="";
						$username="";
						$realname="";
						$email="";
					}
				}else{
					$errores.="El usuario y e-mail ingresados no corresponden. Intente de nuevo<br />\n";
				}
			}
		}
		//Si llegue aca, o no llegaron datos, o hubo errores. Muestro formulario
		include("header.php");
		?>
			<div id="contenido">
		<?php
		if($errores) { 
		?>
				<div id="errores">
					<?php echo $errores; ?>
				</div>
		<?php
		}
		if($success){
		?>
				<div id="success">
					<?php echo $success; ?>
				</div>
		<?php
		}
		?>
				<div id="form_reg">
					<form action="forgot.php" method="POST">
						<table id="table_reg">
							<tr id="tr_reg">
								<td id="td_reg1">User*:</td>
								<td id="td_reg"><input id="text_reg" type="text" name="username" value="<?php echo $username; ?>" /></td>
							</tr>
							<tr id="tr_reg">
								<td id="td_reg1">Email*:</td>
								<td id="td_reg"><input id="text_reg" type="text" name="email" value="<?php echo $email; ?>" /></td>
							</tr>
							<!--<tr id="tr_reg">
								<td colspan="3"><?php include('recaptcha_form.php'); ?></td>
							</tr>!-->
							<tr>
								<td colspan="3">
									<input type="submit" id="submit_reg" value="Reestablecer password" />
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div id="explicacion">
				Para reestablecer su contrase&ntilde;a, indique su nombre de usuario y el e-mail asociado a su cuenta.<br />
				Adem&aacute;s, ingrese las dos palabras que ve en la imagen, para verificar que usted es un humano, y no una computadora haciendo registros autom&aacute;ticos.<br />
				El nuevo password ser&aacute; enviado a esa direcci&oacute;n.
			</div>
		<?php
			include("footer.php");
	}
?>