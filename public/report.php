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
	$title="Reportar link";
	require_once("../includes/initialise.php");
	include('get_sid.php');
	$errores="";
	$success="";
	$formreport=0;
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
	if($_GET['action']){
		if($_GET['action']=='report'){
		//viene a reportar
			if($lid=$_GET['id']){
			//hay LID, todo bien
				$query="SELECT `uid`,`destination` FROM `links` WHERE `lid`='$lid' AND `active`='1' LIMIT 1;";
				$rs = mysql_query ($query);
				if(($temp=mysql_fetch_object($rs))==null){
				//no existe el link/esta inactivo
					$errores.="El link seleccionado no existe o bien fue desactivado.<br />\n";
				}else{
					if(($uid==$temp->uid)||($temp->uid == 0)){
						$errores.="El link seleccionado es p&uacute;blico o te pertenece. <a href=\"mylinks.php?action=edit&lid=$lid&sid=$sid\">Click ac&aacute; para editarlo</a><br />\n";
					}else{
						if($_POST){
						//Hay POST, ya envio el reporte. chequeo que sea correcto
							if($_POST['destination']!=null){
								$parts=@parse_url($_POST['destination']);
								if($parts['scheme']=='')
									$errores.="El destino sugerido est&aacute; incompleto. Por favor, escriba su URL en formato <b>protocolo://servidor/ruta</b> (las &quot;//&quot; pueden obviarse en los casos en que no sean necesarias)<br />\n";
							}
							if(!$uid){
								if($_POST['realname']==""){
									$errores.="Debe ingresar su nombre.<br />\n";
								}
								if($_POST['email']==""){
									$errores.="Debe ingresar su email.<br />\n";
								}else{
									if (!comprobar_email($_POST['email'])){
										$errores.="El email ingresado es inv&aacute;lido.<br />\n";
									}
								}
							}
							$report=$_POST['report'];
							if($errores==null){//reporte correcto, lo envio/pongo pendiente
								if($uid){
								//esta loggeado, mando el mail
									/** @TODO: agarro datos de destinatario y reportador, preparo el mail, y lo mando **/
									
									/**$query="SELECT uid,username,email,realname,active FROM users WHERE uid = $uid AND active = 1 LIMIT 1'";
									$rs = mysql_query ($query);
									if ($fila = mysql_fetch_object ($rs)){
										$realname = $fila ->realname;
										$username = $fila ->username;
										$mail_enviar_a = 
										include('email_report.php');
										$success="Reporte enviado";
										$success.=$mail_cuerpo;
									}else{
										$errores.="Usuario incorrecto<br />";
									}*/
								}else{
								//no esta loggeado, pongo pendiente y mando verificacion
									//Preparo la key
									list($usec, $sec) = explode(' ', microtime());
									$seed = (float) $sec + ((float) $usec * 100000);
									srand($seed);
									$key = md5(uniqid(rand(), 1));
									$seed=null;
									//Fin Preparo la key
									$query="INSERT INTO `reports` (`key`,`realname`,`email`,`lid`,`destination`,`comment`,`active`) VALUES ('$key','".$_POST['realname']."','".$_POST['email']."','$lid','".$_POST['destination']."','".$_POST['report']."','1');";
									$rs = mysql_query ($query);
									$rid = mysql_insert_id();
									/**************************************************************************mail(verificacion de reporte);**************************/
									$key="";
									$success="Se envi&oacute; un e-mail a <b>".$_POST['email']."</b> para verificar la direcci&oacute;n. De no hacerlo, el reporte no ser&aacute; enviado.<br />\n";
								}
							}else{
								//reporte invalido, hubo errores. pido mostrar formulario de reporte
								$formreport=1;
							}
						}else{
							//no hay post, pido mostrar formulario para que usuario ingrese el reporte
							$formreport=1;
						}
					}
				}
			}else{
				//No hay lid. tiro error
				$errores.="El id del link a reportar est&aacute; vac&iacute;o.<br />\n";
			}
		}else{
		//action no es "report"
			if($_GET['action']=='confirm'){
			//usuario viene a confirmar un reporte
				if((($key=$_GET['key'])!="") && (($rid=$_GET['id'])!="")){
				//hay key de reporte. chequeo que sea valido
					$query="SELECT `lid`,`realname`,`email`,`destination`,`comment` FROM `reports` WHERE `rid`='$rid' AND `key`='$key' AND `active`='1' LIMIT 1;";
					$rs=mysql_query($query);
					if(($temp=mysql_fetch_object($rs))==null){
					//el key no existe
						$errores.="La clave ingresada es inv&aacute;lida, o el reporte ya fue confirmado y enviado.<br />\n";
					}else{
					//key valido, envio el mail de reporte al due�o del link, desactivo el pendiente e informo que se mand� el reporte
						$mail_es_usuario = 0;
						$realname= $temp->realname;
						$id_link = $temp->lid;
						$mail_detination = $temp->destination;
						$mail_dice = $temp->comment;
						$mail_enviar_a = $temp -> email;
						include('email_report.php');
						$success="El reporte fue confirmado y enviado correctamente al propietario del link reportado.";
						$query="UPDATE `reports` SET `active`='0' WHERE `rid`='$rid' LIMIT 1;";
						$rs=mysql_query($query);
						if(!mysql_affected_rows())
							$errores.="Error al intentar actualizar el reporte en la base de datos.<br />\n";
					}
				}else{
				//no hay key de reporte. error
					$errores.="El identificador y/o la clave de reporte est&aacute;n vac&iacute;os.<br />\n";
				}
			}else{
			//Action no es report ni confirm. me frute�. le tiro error.
				$errores.="La acci&oacute;n indicada es inv&aacute;lida.<br />\n";
			}
		}
	}else{
	//No hay action. tiro error
		$errores.="No se indic&oacute; ninguna acci&oacute;n para realizar.<br />\n";
	}
	include('header.php');
	?>
		<div id="contenido">
	<?php
	if($success){
		?>
			<div id="success"><?php echo $success; ?></div>
		<?php
	}
	if($errores){
		?>
			<div id="errores"><?php echo $errores; ?></div>
		<?php
	}
	if($formreport){
		?>
			<div id="form_reg">
				<form action="?action=report&id=<?php echo $lid;?>&sid=<?php echo $sid;?>" method="POST">
					<table id="table_reg">
		<?php
		if(!$uid){
		?>
						<tr id="tr_reg">
							<td id="td_reg1">Nombre:</td>
							<td id="td_reg2"><input type="text" name="realname" size="35" value="<?php echo $_POST['realname']; ?>" /></td>
						</tr>
						<tr id="tr_reg">
							<td id="td_reg1">E-Mail:</td>
							<td id="td_reg2"><input type="text" name="email" size="35" value="<?php echo $_POST['email']; ?>" /></td>
						</tr>
		<?php
		}
		?>
						<tr id="tr_reg">
							<td id="td_reg1">Link LaMantengo:</td>
							<td id="td_reg2"><a href="visit.php?id=<?php echo $lid."&sid=$sid"; ?>">http://www.lamantengo.com.ar/visit.php?id=<?php echo $lid;?></a></td>
						</tr>
						<tr id="tr_reg">
							<td id="td_reg1">Destino sugerido:</td>
							<td id="td_reg2"><input type="text" name="destination" size="35" value="<?php echo $_POST['destination']; ?>" /></td>
						</tr>
						<tr id="tr_reg">
							<td id="td_reg1">Comentario:</td>
							<td id="td_reg2"><textarea name="report" cols="40" rows="10"><?php echo $_POST['report']; ?></textarea></td>
						</tr>
		<?php
		if(!$uid){
		?>
						<tr id="tr_reg">
							<td colspan="2"><?php include('recaptcha_form.php');?></td>
						</tr>
		<?php
		}
		?>
						<tr id="tr_reg">
							<td colspan="2"><input type="submit" value="Enviar" /></td>
						</tr>
					</table>
				</form>
			</div>
		<?php
	}
	include('footer.php');
?>