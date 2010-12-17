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
	$title="Ver link";
	require_once("../includes/initialise.php");
	include('get_sid.php');
	$errores="";
	$id=$_GET['id'];
	if(!$id){
		$errores.="No hay id del link (URL inv&aacute;lida)<br />\n";
	}else{
		//hay id. lo busco en la db
		$query="SELECT `uid`,`destination`,`description`,`lastmod`, `visits` FROM `links` WHERE `lid`='$id' AND `active`='1' LIMIT 0, 1;";
		$rs=mysql_query($query);
		if(($temp=@mysql_fetch_object($rs))==null){
			$errores.="Link inexistente/desactivado<br />\n";
		}else{
			$destination=$temp->destination;
			$description=$temp->description;
			$lastmod=$temp->lastmod;
			$visits=$temp->visits;
			$oid=$temp->uid;
		}
	}
	include('header.php');
	?>
	<div id="contenido">
		<h2><?php echo $title;?></h2>
	<?php
	if($errores){
	?>
		<div id="errores"><?php echo $errores;?></div>
	<?php
	}else{
	if($_GET['new']){
	?>
		<div id="success">El link fue agregado con &eacute;xito.</div>
	<?php
	}
	?>
		<div id="view">
			<table id="table_view">
				<tr>
					<td class="headers_view" width="35%">Link LaMantengo:</td>
					<td class="data_view">http://<?php echo $_SERVER['HTTP_HOST'];?>/visit.php?id=<?php echo $id;?></td>
				</tr>
				<tr>
					<td class="headers_view">Destino:</td>
					<td class="data_view"><a href="visit.php?id=<?php echo $id;?>" target="_blank"><?php echo $destination;?></a></td>
				</tr>
				<tr>
					<td class="headers_view">Descripci&oacute;n:</td>
					<td class="description_view"><?php echo $description; ?></td>
				</tr>
				<tr>
					<td class="headers_view">&Uacute;ltima modificaci&oacute;n:</td>
					<td class="data_view"><?php echo $lastmod; ?></td>
				</tr>
		<?php
		if(($oid==$uid)||($oid==0)){//Si es el propietario
			?>
				<tr>
					<td class="headers_view">Visitas:</td>
					<td class="data_view"><?php echo $visits; ?></td>
				</tr>
				<tr id="imglink">
					<td colspan="2" align="center" id="imglink">
						<a href="mylinks.php?action=edit&lid=<?php echo $id."&sid=".$sid;?>" id="imglink" title="Editar"><img src="<?php echo IMAGE_PATH . DS; ?>edit.png" id="imglink" /> Editar</a>
						<a href="mylinks.php?action=delete&lid=<?php echo $id."&sid=".$sid;?>" title="Eliminar" id="imglink"><img src="<?php echo IMAGE_PATH . DS; ?>delete.png" id="imglink" /> Eliminar</a>
					</td>
				</tr>
			<?php
		}
		?>
			</table>
		</div>
		<div id="explicacion">
			Utilize esta ventana para saber a qu&eacute; p&aacute;gina apunta un link. Clickeando en la direcci&oacute;n destino podr&aacute; visitar el sitio.<br />
			Si usted es el propietario del link, o bien si es un link p&uacute;blico, tambi&eacute;n encontrar&aacute; la posibilidad de editar el link, o bien darlo de baja.
			Para ello, pulse los botones <img src="<?php echo IMAGE_PATH . DS; ?>edit.png" alt="Editar" title="Editar"> o <img src="<?php echo IMAGE_PATH . DS; ?>delete.png" alt="Eliminar" title="Eliminar" />, respectivamente.
		</div>
	<?php
	}
	echo "</div>";
	include("footer.php");
?>