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
	$title="Registrar cuenta";
	require_once("../includes/initialise.php");
	include('get_sid.php');
	include('generar_password.php');
	$errores="";
	function comprobar_email($address) {
		if (function_exists('filter_var')) {
			if(filter_var($address, FILTER_VALIDATE_EMAIL) === FALSE) {
				return false;
			} else {
				return true;
			}
		} else {
			return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $address);
		}
	}
	if(!$uid){ //no loggeado
		if($_POST){ //Proceso datos del registro
			$username=$_POST['username'];
			$realname=$_POST['realname'];
			$email=$_POST['email'];
			$email2=$_POST['email2'];
			$agree=$_POST['agree'];
			//busco errores y los meto como lista en $errores
			if(!($agree))
				$errores.="Debes aceptar los T&eacute;rminos del Servicio para poder registrarte.<br />\n";
			if($username=="")
				$errores.="El nombre de usuario est&aacute; vac&iacute;o.<br />\n";
			else
				if(strlen($username)<4)
					$errores.="El nombre de usuario debe tener 4 caracteres como m&iacute;nimo.<br />\n";
			if($email=="")
				$errores.="El e-mail est&aacute; vac&iacute;o.<br />\n";
			else{
				$email=strtolower($email);
				$email2=strtolower($email2);
				if($email!=$email2)
					$errores.="Los e-mail no coinciden";
				else
					if(!(comprobar_email($email)))
						$errores.="El e-mail ingresado es inv&aacute;lido";
			}
			/************************* chequeo recaptcha **************************************
			include('recaptcha_check.php');
			/**********************fin chequeo recaptcha **************************************/
			if(!$errores){ //no hay errores ==> registro, mando verificacion y muestro succes (salvo q falle SQL)
				/*************************************************************************************
				** NO USO ESTO. VERIFICO EL EMAIL MEDIANTE EL ENVIO DEL PASSWORD
				** //Genero un activation_key completamente random (Sacado de Coppermine 1.4.19 - register.php:261-264)
				** list($usec, $sec) = explode(' ', microtime());
				** $seed = (float) $sec + ((float) $usec * 100000);
				** srand($seed);
				** $act_key = md5(uniqid(rand(), 1));
				//Fin Genero activation_key
				***************************************************************************************/
				$password=generar_pass();
				$pass_hash=md5($password);
				$query="INSERT INTO `users` (`username`,`username_clean` ,`realname` ,`email` ,`password` ,`active`)
						VALUES ( '$username', '".strtolower($username)."', '$realname', '$email', '$pass_hash', '1');";
				$rs = mysql_query ($query);
				if(mysql_errno() == 1062)
					$errores.="El nombre de usuario o cuenta de e-mail ingresados ya se encuentran registrados.<br />\n";
				if(!$errores){
					//envio activacion y concateno errores
					$query="SELECT `uid` FROM `users` ORDER BY `uid` DESC LIMIT 0 , 1;";
					$rs = mysql_query($query);
					$temp=mysql_fetch_object($rs);
					$uid=$temp->uid;
					include("email_register.php");
					$password="";
					$uid="";
					if(!$errores){
						$success="Su cuenta ha sido creada exitosamente. Revise su e-mail (<b>$email</b>) para obtener sus datos de ingreso.";
					}else{
						$success=$mail_cuerpo."<br /><br /><b>** IMPORTANTE **:</b> Est&aacute;s viendo este mensaje porque el sitio est&aacute; en beta. Probablemente tu cuenta sea eliminada luego de unos d&iacute;as, o se actualizar&aacute; tu password para verificar tu email";
					}
				}
			}
		} //FIN POST
	}else{ //Usuario loggeado, lo echo
		$errores.="Ya est&aacute; loggeado, por lo que no puede volver a registrarse<br />\n";
	}
	//muestro la pagina
	include('header.php');
	?>
		<div id="contenido">
	<?php
	if($errores){
		?>
			<div id="errores"><?php echo $errores; ?></div>
		<?php
	}
	if($success){
		?>
			<div id="success"><?php echo $success; ?></div>
		<?php
	}
	?>
			<div id="form_reg">
				<form action="register.php" method="POST">
					<table id="table_reg">
						<tr id="tr_reg">
							<td id="td_reg1">User*:</td>
							<td id="td_reg"><input id="text_reg" type="text" name="username" value="<?php echo $_POST['username']; ?>" /></td>
							<td id="td_reg2">(m&iacute;nimo 4 caracteres)</td>
						</tr>
						<tr id="tr_reg">
							<td id="td_reg1">Nombre:</td>
							<td id="td_reg"><input id="text_reg" type="text" name="realname" value="<?php echo $_POST['realname']; ?>" /></td>
							<td id="td_reg2">(para usar en caso de contacto)</td>
						</tr>
						<tr id="tr_reg">
							<td id="td_reg1">Email*:</td>
							<td id="td_reg"><input id="text_reg" type="text" name="email" value="<?php echo $_POST['email']; ?>" /></td>
							<td id="td_reg2">(v&aacute;lido - se enviar&aacute; la contrase&ntilde;a)</td>
						</tr>
						<tr id="tr_reg">
							<td id="td_reg1">Repite Email*:</td>
							<td id="td_reg"><input id="text_reg" type="text" name="email2" value="<?php echo $_POST['email2']; ?>" /></td>
							<td id="td_reg2">(repite la direcci&oacute;n)</td>
						</tr>
						<?php /*<tr id="tr_reg">
							<td id="td_reg1">Password*:</td>
							<td id="td_reg"><input id="pass_reg" type="password" name="password" value="" /></td>
							<td id="td_reg2">(6 caracteres m&iacute;nimo)</td>
						</tr>
						<tr id="tr_reg">
							<td id="td_reg1">Repite password*:</td>
							<td id="td_reg"><input id="pass_reg" type="password" name="pass2" value="" /></td>
							<td id="td_reg2">(para evitar errores de tipeo)</td>
						</tr>
						<tr id="tr_reg">
							<td colspan="2"><?php include('recaptcha_form.php'); ?></td>
							<td id="td_reg2">Ingrese las dos palabras para evitar registros automatizados (y <a href="visit.php?id=33<?php if($sid) echo "&sid=$sid";?>" title="Leer sobre ReCaptcha y la digitalizaci&oacute;n de libros" target="_blank">ayudar a digitalizar libros</a>)</td>
						</tr>*/?>
						<tr>
							<td colspan="3" id="td_check_reg">
								<input name="agree" type="checkbox" title="Acepto los ToS" /> Acepto los <a href="tos.php?sid=<?php echo $sid;?>" title="Leer los ToS">T&eacute;rminos del Servicio</a>
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<input type="submit" id="submit_reg" value="Registrarse" />
								<input type="reset" id="reset_reg" value="Limpiar" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div id="explicacion">
			Ingrese el nombre de usuario con el que quiere registrarse en el sitio, su nombre real (opcional, solamente figurar&aacute; cuando debamos contactarnos con usted), y un e-mail v&aacute;lido.<br />
			Adem&aacute;s, ingrese las dos palabras que ve en la imagen, para verificar que usted es un humano, y no una computadora haciendo registros autom&aacute;ticos.<br />
			Se enviar&aacute; un mensaje a esa direcci&oacute;n indicando sus datos de inicio de sesi&oacute;n, y ser&aacute; la direcci&oacute;n de contacto asociada a su cuenta.<br />
			Para registrarse en el sitio tiene que estar de acuerdo con nuestros <a href="tos.php?sid=<?php echo $sid; ?>" target="_blank" title="Leer los ToS (en una ventana nueva)">T&eacute;rminos del Servicio</a>.
		</div>
	<?php
	include("footer.php");
?>