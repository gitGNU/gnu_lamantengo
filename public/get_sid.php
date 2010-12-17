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
		//Prefiero la cookie, desp el get, y si no, vacio
		if($_COOKIE['sid']!=""){
			$sid=$_COOKIE['sid'];
			$origen_sid = 'cookie';
		}elseif ($_GET['sid']!=""){
			$sid=$_GET['sid'];
			$origen_sid = 'get';
		}else{
			$sid="";
			$origen_sid='';
		}
		//Si sid no mide 32 caracteres, me fruteo... limpio
		if(strlen($sid)!=32){
			$sid="";
			$origen_sid='';
		}
		if($sid){
			//si hay sid, la busco en la db y traigo uid y tiempos
			$query="SELECT `uid`,`lastmod`,`timeout`,`browser`,`ip` FROM `sessions` WHERE `sid`='$sid';";
			//echo $query;
			$rs=mysql_query($query);
			$temp=mysql_fetch_object($rs);
			if($temp!=""){//existe la sesion
				$uid=0;
				if(($temp->browser != $_SERVER['HTTP_USER_AGENT'])||(($origen_sid != 'cookie')&&($temp->ip != $_SERVER['REMOTE_ADDR']))){
					//cambio el browser, o la sesion no es por cookie y cambio la ip. ergo, le regenero el sid, pero la sesion sigue viva
					$sid='';
				}
				if(($temp->timeout) && (($temp->lastmod + $temp->timeout) < time())){
					//la sesion tiene timeout, y expiro. reutilizo la sid (cambio el uid a 0 y cambio el lastmod, pero sigo usando la misma sid para el user
					$query="UPDATE `sessions` SET `lastmod` = '".time()."', `uid`=0 WHERE `sessions`.`sid` = '$sid' LIMIT 1 ;";
					$rs=mysql_query($query);
				}else{
					//sesion valida. asigno uid y actualizo lastmod
					$uid=$temp->uid;
					$query="UPDATE `sessions` SET `lastmod` = '".time()."' WHERE `sid`='$sid'; ";
					$rs=mysql_query($query);
				}
				setcookie("sid","$sid");
			}else{
				//no encontre la sid
				$sid="";
			}
		}
		if(!($sid)){
			//o no habia sid, o no la encontre en la db. creo una sid nueva y la guardo
			list($usec, $sec) = explode(' ', microtime());
			$seed = (float) $sec + ((float) $usec * 100000);
			srand($seed);
			$sid = md5(uniqid(rand(), 1));
			$query="INSERT INTO `sessions` (`sid`,`uid` ,`lastmod` ,`timeout`,`browser`,`ip`) VALUES ( '$sid', '0', '".time()."', '900','".$_SERVER["HTTP_USER_AGENT"]."','".$_SERVER['REMOTE_ADDR']."');";
			//echo $query;
			$rs=mysql_query($query);
			setcookie("sid","$sid");
			$uid="";
		}
		//echo $query;
	}else{
		include("404.php");
	}
?>