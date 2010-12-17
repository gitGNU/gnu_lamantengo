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

require_once("../includes/initialise.php");

if (defined('INSITE')) {
    if ($uid) { //Usuario esta loggeado
        $query = "SELECT `username`, `email`,`realname` FROM `users` WHERE `uid`='$uid' LIMIT 1;";
        $rs = mysql_query($query);
        if ($fila = mysql_fetch_object($rs)) {
            $username = $fila->username;
            $email = $fila->email;
            $realname = $fila->realname;
        }
?>
        <a href="profile.php?sid=<?php echo $sid; ?>" title="Perfil de usuario">Perfil</a> -
        <a href="mylinks.php?sid=<?php echo $sid; ?>" title="Ver todos los links del usuario">Mis links</a> -
        <a href="logout.php?sid=<?php echo $sid; ?>" title="Cerrar la sesi&oacute;n actual">Salir [<b><?php echo $username; ?></b>]</a>
<?php
    } else { //Usuario no esta loggeado
?><form action="login.php?sid=<?php echo $sid; ?>" method="post">
        				User: <input type="text" name="user" title="<?php echo $language->translate("username"); ?>" size="8" />
        				Password: <input type="password" name="password" title="<?php echo $language->translate("password"); ?>" size="8" />
            <input type="hidden" name="login" value="1" />
            <input type="submit" id="login" value="<?php echo $language->translate("login_button"); ?>" title="<?php echo $language->translate("login_to_site"); ?>" />
        </form>
        <a href="register.php" title="<?php echo $language->translate("register_title"); ?>"><?php echo $language->translate("register"); ?></a> -
        <a href="forgot.php" title="<?php echo $language->translate("forgot_password_title"); ?>"><?php echo $language->translate("forgot_password"); ?></a>
<?php
    } //FIN if($uid)
} else {//No esta en el sitio. Link directo
    include("404.php"); //Tirar 404
}
?>