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
define('INSITE', 1);

require_once("../includes/initialise.php");

include('get_sid.php');

if (($_GET['language'] == 'en') || ($_GET['language'] == 'es')) {
    $language->setLocale($_GET['language'], $_GET['country']);
}

$title = $language->translate("title_home");

$errores = "";
if ($_POST) {
    $parts = @parse_url($_POST['destination']);
    if ($parts['scheme'] == '')
        if (!$errores) {
            if ($uid)
                $uuid = $uid;
            else
                $uuid=0;
            $query = "INSERT INTO `links` (`uid` ,`destination`, `description`) VALUES ( $uuid, '" . $_POST['destination'] . "','" . $_POST['description'] . "');";
            $rs = mysql_query($query);
            if (!(mysql_errno())) { //Si no hubo errores, success
                $lid = mysql_insert_id();
                header('Location: view.php?id=' . $lid . '&new=1&sid=' . $sid);
                exit;
            } else {
                $errores.= $language->translate("error_insert_link");
            }
        }
} else {
    if ($_GET['visitnoid']) //No hay id en visit.php
        $errores.="La direcci&oacute;n que intenta visitar es err&oacute;nea (no incluye el id del link). Por favor, verif&iacute;quela.<br />\n";
    if ($_GET['visitidnoexist'])//El link de visit.php no existe o fue dado de baja
        $errores.="El link que intenta visitar no existe o fue dado de baja en nuestro sitio.<br />\n";
}
include("header.php");
?>
<div id="contenido">
    <?php
    if ($success) {
    ?>
        <div id="success"><?php echo $success; ?></div>
    <?php
    }
    if ($errores != null) { //Hay errores, los imprimo
    ?>
        <div id="errores"><?php echo $errores; ?></div>
    <?php
    }
    ?>
    <div align="center">
        <form action="link.php<?php if ($sid)
        echo "?sid=$sid"; ?>" method="post">
            <input type="text" name="destination" size="35" id="dest_text" value="<?php if ($_POST['destination'] != "")
                  echo $_POST['destination']; ?>" />
            <input type="submit" value="<?php echo $language->translate("link_button"); ?>" id="link_button" /><br />
            <input type="text" name="description" size="83" maxlength="120" id="desc_text" value="<?php if ($_POST['description'] != "")
                       echo $_POST['description']; ?>" />&nbsp;
        </form>
    </div>
</div>
<div id="explanation">
    <?php
                   echo $language->translate("instructions");
                   echo "</div>";

                   include("footer.php");
    ?>
