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
require_once("../includes/initialise.php");

define('INSITE', 1);

include('get_sid.php');

$title = $language->translate("title_login");
$errores = "";

if ($uid) { // Already logged in
    $errores .= $language->translate("error_loggedin");
    
} else { // Not logged in
    if ($_POST['login']) { // POST data
        if ($_POST['user'] == "") {
            $errores .= $language->translate("error_username_empty");
        } else {
            $user = $_POST['user'];
        }
        if ($_POST['password'] == "") {
            $errores .= $language->translate("error_password_empty");
        } else {
            $pass = md5($_POST['password']);
            $_POST['password'] = "";
        }
        if (!($errores)) {
            $query = "SELECT uid,username,active FROM users WHERE LOWER(username) ='" . strtolower($user) . "' AND password='$pass'";
            $rs = mysql_query($query);
            if ($fila = mysql_fetch_object($rs)) {
                if (!($fila->active))
                    $errores .= $language->translate("error_user_disabled");
                else {
                    $uid = $fila->uid;
                    $user = $fila->username;
                    //Actualizo el uid en la session
                    $query = "UPDATE `sessions` SET `uid` = '$uid' WHERE `sid`='$sid'; ";
                    $rs = mysql_query($query);
                    $success = $language->translate("login_welcome");
                    $success.= $language->translate("login_redirect");
                    $success.="<meta http-equiv=\"refresh\" content=\"3,index.php?sid=$sid\" />";
                }
            } else {
                $errores .= "Usuario inexistente/Contrase&ntilde;a incorrecta. Intente de nuevo<br />\n";
            }
        }
    }
    //Muestro formulario
    include("header.php");
?>
    <div id="contenido">
    <?php if ($errores) {
 ?>
        <div id="errores"><?php echo $errores; ?></div>
    <?php
    }
    if ($success) {
    ?>
        <div id="success"><?php echo $success; ?></div>
    <?php
    } else {
    ?>
        <div id="login">
<?php include("reging.php"); ?>
    </div>
    <?php
    }
    ?>
</div>
<?php
    include("footer.php");
}
?>