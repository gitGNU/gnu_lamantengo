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
	$title="Mis links";
	require_once("../includes/initialise.php");
	include('get_sid.php');
	$errores="";
	$success="";
	$formedit=0;
	$captcha=0;
	if($_GET['action']){
		if($_GET['action']=='edit'){
			if($_POST!=null){
				$parts=@parse_url($_POST['destination']);
				if($parts['scheme']=='')
					$errores.="La URL ingresada est&aacute; incompleta. Por favor, escriba su URL en formato <b>protocolo://servidor/ruta</b> (las &quot;//&quot; pueden obviarse en los casos en que no sean necesarias)<br />\n";
				if(!($lid=$_POST['lid']))
					$errores.="El id de link est&aacute; vac&iacute;o<br />\n";
				if(!$uid){
					/************************* chequeo recaptcha **************************************
					include('recaptcha_check.php');
					/**********************fin chequeo recaptcha **************************************/
				}
				if($errores==null){
					$query="UPDATE `links` SET `destination`='".$_POST['destination']."', `description`='".$_POST['description']."' WHERE `lid`='$lid' AND (`uid`='$uid' OR `uid`='0') AND `active`='1' LIMIT 1;";
					$rs=mysql_query($query);
					if(mysql_affected_rows())
						$success="El link n&ordm; $lid fue actualizado con &eacute;xito";
					else
						$errores.="Link inexistente / No tienes permiso para editar este link<br />\n";
				}else{
					$formedit=1;
				}
			}else{
				if($lid=$_GET['lid']){
					if($uid){
						$query="SELECT `destination`,`description`,`lastmod` FROM `links` WHERE `active`='1' AND (`uid`='$uid' OR `uid`='0') AND `lid`='$lid' LIMIT 1;";
					}else{
						$query="SELECT `destination`,`description`,`lastmod` FROM `links` WHERE `active`='1' AND `uid`='0' AND `lid`='$lid' LIMIT 1;";
					}
					$rs = mysql_query($query);
					if($temp=mysql_fetch_object($rs)){
						$destination=$temp->destination;
						$description=$temp->description;
						$lastmod=$temp->lastmod;
						$formedit=1;
						/**if(!$uid)
							$captcha=1;**/
					}else{
						$errores.="Link inexistente / No tienes permiso para editar este link<br />\n";
					}
				}else{
					$errores.="El id de link est&aacute; vac&iacute;o<br />\n";
				}
			}
		}else{
			if($_GET['action']=='delete'){
				if($_POST){ //elimino muchos links juntos desde mylinks.php
					if(!($uid))
						$errores.="Para eliminar enlaces masivamente tiene que <a href=\"login.php?sid=$sid\">iniciar sesi&oacute;n</a>. Si no tiene una cuenta, <a href=\"register.php?sid=$sid\">reg&iacute;strese</a><br />\n";
					else{
						foreach($_POST as $key=> $value){
							$query="UPDATE `links` SET `active`='0' WHERE `lid`='$key' AND (`uid`='$uid' OR `uid`='0') AND `active`='1' LIMIT 1;";
							$rs=mysql_query($query);
							if(mysql_affected_rows())
								$success.="El link n&ordm;$key fue eliminado correctamente<br />\n";
							else
								$errores.="Link n&ordm;$key: link inexistente / No tienes permiso para editar este link<br />\n";
						}
					}
				}else{
					if($lid=$_GET['lid']){ //elimino un unico link (por get)
						if($uid)
							$query="UPDATE `links` SET `active`='0' WHERE `lid`='$lid' AND (`uid`='$uid' OR `uid`='0') AND `active`='1' LIMIT 1;";
						else
							$query="UPDATE `links` SET `active`='0' WHERE `lid`='$lid' AND `uid`='0' AND `active`='1' LIMIT 1;";
						$rs = mysql_query($query);
						if(mysql_affected_rows())
							$success="El link n&ordm;$lid fue eliminado correctamente<br />\n";
						else
							$errores.="Link inexistente / No tienes permiso para editar este link<br />\n";
					}else{
						$errores.="No se ha ingresado el id del link que se quiere eliminar<br />\n";
					}
				}
			}else{
				$errores.="Acci&oacute;n inv&aacute;lida<br />\n";
			}
		}
	}else{
		if(!$uid){
			//no est� loggeado, le digo que se loggee
			$errores.="Para ver sus enlaces tiene que <a href=\"login.php?sid=$sid\">iniciar sesi&oacute;n</a>. Si no tiene una cuenta, <a href=\"register.php?sid=$sid\">reg&iacute;strese</a><br />\n";
		}
	}
	if($uid){
		//loggeado, pido links
		$query="SELECT `lid`, `destination`, `description`, `lastmod`, `visits` FROM `links` WHERE `uid`='$uid' AND `active`='1';";
		$rs_links = mysql_query ($query);
		if(mysql_errno())
			$errores.="Error al conectar con la base de datos<br />\n";
	}
	include('header.php');
	?>
	<div id="contenido">
		<h2><?php echo $title; ?></h2>
	<?php
	if($success){
	?>
		<div id="success">
			<?php echo $success; ?>
		</div>
	<?php
	}
	if($errores){
	?>
		<div id="errores">
			<?php echo $errores; ?>
		</div>
	<?php
	}
	if($formedit){
	?>
		<div id="formedit">
			<form action="?action=edit&sid=<?php echo $sid; ?>" method="POST">
				<input type="hidden" name="lid" value="<?php echo $lid; ?>" />
				<table id="table_edit">
					<tr id="tr_table_edit">
						<td id="td1_table_edit">Link LaMantengo:</td>
						<td id="td2_table_edit"><a href="visit.php?id=<?php echo $lid."&sid=$sid"; ?>">http://www.lamantengo.com.ar/visit.php?id=<?php echo $lid;?></a></td>
					</tr>
					<tr id="tr_table_edit">
						<td id="td1_table_edit">Destino:</td>
						<td id="td2_table_edit"><input type="text" name="destination" value="<?php echo $destination;?>" id="input_dest_table_edit" size="40" /></td>
					</tr>
					<tr id="tr_table_edit">
						<td id="td1_table_edit">Descripci&oacute;n:</td>
						<td id="td2_table_edit"><textarea name="description" cols="40" rows="3"><?php echo $description; ?></textarea></td>
					</tr>
					<tr id="tr_table_edit">
						<td id="td1_table_edit">&Uacute;ltima modificaci&oacute;n:</td>
						<td id="td2_table_edit"><?php echo $lastmod;?></td>
					</tr>
					<tr id="tr_table_edit">
						<td colspan="2"><input type="submit" value="Guardar cambios" id="submit_edit" /> <input type="reset" value="Resetear" id="reset_edit" /></td>
					</tr>
				</table>
			</form>
		</div>
	<?php
	}
	?>
		<div id="mylinks_div">
			<form action="?action=delete&sid=<?php echo $sid; ?>" method="POST">
				<table id="tabla_links">
					<tr id="links_tr_head">
						<td id="links_head_td">&nbsp;</td>
						<td id="links_head_td">Destino</td>
						<td id="links_head_td">Link</td>
						<td id="links_head_td">Descripci&oacute;n</td>
						<td id="links_head_td">Visitas</td>
						<td id="links_head_td">Editar</td>
						<td id="links_head_td">Eliminar</td>
						<td id="links_head_td">&Uacute;ltima modificaci&oacute;n</td>
					</tr>
	<?php
	while(($temp=@mysql_fetch_object($rs_links))!=null){
	?>
					<tr id="links_tr">
						<td id="chk_td_links"><input type="checkbox" name="<?php echo $temp->lid;?>" id="chk_links" /></td>
						<td id="dest_td_links"><a href="view.php?id=<?php echo $temp->lid."&sid=".$sid;?>" target="_blank" title="Ver enlace en otra ventana"><?php echo $temp->destination;?></a></td>
						<td id="link_td_links"><a href="visit.php?id=<?php echo $temp->lid."&sid=".$sid;?>" title="Ver link"><img src="<?php echo IMAGE_PATH . DS; ?>link.png" title="Link LaMantengo" alt="Link LaMantengo" /></a></td>
						<td id="desc_td_links"><?php echo $temp->description; ?></td>
						<td id="visits_td_links"><?php echo $temp->visits; ?></td>
						<td id="edit_td_links"><a href="?action=edit&lid=<?php echo $temp->lid."&sid=$sid"; ?>" title="Editar"><img src="<?php echo IMAGE_PATH . DS; ?>edit.png" alt="Editar" title="Editar" /></a></td>
						<td id="delete_td_links"><a href="?action=delete&lid=<?php echo $temp->lid."&sid=$sid"; ?>" title="Eliminar"><img src="<?php echo IMAGE_PATH . DS; ?>delete.png" alt="Eliminar" title="Eliminar" /></a></td>
						<td id="lastmod_td_links"><?php echo $temp->lastmod;?></td>
					</tr>
	<?php
	}
	?>
						<tr id="links_tr_head">
							<td colspan="6" id="submit_td_links">&nbsp;</td>
						</tr>
						<tr id="links_tr_head">
							<td colspan="6" id="submit_td_links"><input type="submit" id="submit_links" value="Eliminar seleccionados" /></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div id="explicacion">
			Clickee el bot&oacute;n <img src="images/edit.png" alt="Editar" title="Editar" /> a la derecha de un link para cambiar el destino del mismo, o bien <img src="<?php echo IMAGE_PATH . DS; ?>delete.png" alt="Eliminar" title="Eliminar" /> para desactivarlo permanentemente.<br />
			Para eliminar m&uacute;ltiples links juntos, tilde la casilla a la izquierda de cada link que quiera eliminar, y luego presione el bot&oacute;n &quot;Eliminar seleccionados&quot;.
		</div>
	<?php
	include("footer.php");
?>