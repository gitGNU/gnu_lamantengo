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
	$title="Visitar sitio";
	include('dbconect.php');
	include('get_sid.php');
	$errores="";
	if(!$lid=$_GET['id']){//no hay id, aviso el error
		header('Location: index.php?sid='.$sid.'&visitnoid=1');
	}else{ //hay id, lo busco
		$query="SELECT `destination`, `description`, `lastmod`, `uid`, `visits` FROM `links` WHERE `lid`='$lid' AND `active`='1';";
		$rs = mysql_query($query,$cnx);
		if($temp=mysql_fetch_object($rs)){ //Existe el link, lo muestro
			$query2 = "UPDATE `links` SET `visits`='".($temp->visits + 1)."', `lastmod`='".$temp->lastmod."'  WHERE `lid`='$lid' LIMIT 1;";
			@mysql_query($query2, $cnx);
			$owns = ($temp->uid == 0) || ($temp->uid == $uid);
			?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ar" xml:lang="es-ar">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta http-equiv="Content-Language" content="es-ar" />
		<meta name="description" content="Generador de links con destino modificable" />
		<link href="style.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
		<title>Visitar sitio - LaMantengo.Com.Ar</title>
	</head>
	<body>
		<div id="contenido_visit">
			<table height="100%" width="100%" id="table_contenido_visit">
				<tr id="tr_contenido_visit">
					<td id="frame_visit">
						<div id="panel_visit">
							<div id="links_visit">
								<div id="logo_visit">
									<a href="index.php" title="Ir a LaMantengo.Com.Ar" id="logo_link_visit"><img src="images/logo-visit.png" alt="Logo LaMantengo.Com.Ar" /></a></div>
								</div>
								<div id="cp_visit">
									<a href="<?php echo $temp->destination;?>" title="Quitar marco"><img src="images/cross.png" alt="Quitar marco" /></a><br />
									<?php if($owns) { ?>
									<a href="mylinks.php?action=edit&lid=<?php echo $lid;?>&sid=<?php echo $sid;?>" title="Editar destino del link">Editar</a><br />
									<a href="mylinks.php?action=delete&lid=<?php echo $lid;?>&sid=<?php echo $sid;?>" title="Eliminar link">Eliminar</a>
									<?php }else{ ?>
									<a href="report.php?action=report&id=<?php echo $lid;?>&sid=<?php echo $sid;?>" title ="Reportar link caducado/invalido">Reportar</a><br />
									<?php } ?>
								</div>
								Link NoHuyas: <span id="link_nh_visit"><?php echo "http://".$_SERVER['HTTP_HOST']."/visit.php?id=".$lid;?></span><br />
								Destino: <span id="link_dest_visit"><?php echo $temp->destination; ?></span><br />
								Descripci&oacute;n: <span id="link_desc_visit"><?php echo $temp->description; ?></span><br />
								&Uacute;ltima modificaci&oacute;n: <span id="lastmod_visit"><?php echo $temp->lastmod;?></span>
							</div>
					</td>
				</tr>
				<tr id="destino">
					<td><iframe id="dest_frame" frameborder="0" src="<?php echo $temp->destination;?>"></iframe></td>
				</tr>
			</table>
		</div>
	</body>
</html>
<?php
		}else{
			//Hay id, pero est� desactivado o no existe
			header('Location: index.php?sid='.$sid.'&visitidnoexist=1');
		}
	}
?>