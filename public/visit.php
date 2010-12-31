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

    $title = $language->translate("title_visit");

    $errores = "";
    if (!$lid = $_GET['id']) { // no id, notice the error
        header('Location: index.php?sid=' . $sid . '&visitnoid=1');
    }
    else { // Go there, I look
        $query = "SELECT `destination`, `description`, `lastmod`, `uid`, `visits` FROM `links` WHERE `lid`='$lid' AND `active`='1';";
        $rs = mysql_query($query, $cnx);
        if ($temp = mysql_fetch_object($rs)) { // There is a link, I show
            $query2 = "UPDATE `links` SET `visits`='" . ($temp->visits + 1) . "', `lastmod`='" . $temp->lastmod . "'  WHERE `lid`='$lid' LIMIT 1;";
            @mysql_query($query2, $cnx);
            $owns = ($temp->uid == 0) || ($temp->uid == $uid);

?>
            <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ar" xml:lang="es-ar">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta http-equiv="Content-Style-Type" content="text/css" />
                    <meta http-equiv="Content-Language" content="es-ar" />
                    <meta name="description" content="Generador de links con destino modificable" />
                    <link href="includes/styles/style.css" rel="stylesheet" type="text/css" />
                    <link rel="shortcut icon" href="<?php echo IMAGE_PATH . DS; ?>favicon.ico" type="image/x-icon" />
                    <title><?php $language->translate("title_visit"); ?> - LaMantengo.Com.Ar</title>
                </head>
                <body>
                    <div id="contenido_visit">
                        <table height="100%" width="100%" id="table_contenido_visit">
                            <tr id="tr_contenido_visit">
                                <td id="frame_visit">
                                    <div id="panel_visit">
                                        <div id="links_visit">
                                            <div id="logo_visit">
                                                <a href="index.php" title="<?php echo $language->translate("go_to"); ?>" id="logo_link_visit"><img src="<?php echo IMAGE_PATH . DS; ?>logo-visit.png" alt="Logo LaMantengo.Com.Ar" /></a></div>
                                        </div>
                                        <div id="cp_visit">
                                            <a href="<?php echo $temp->destination; ?>" title="<?php echo $language->translate("remove_frame"); ?>"><img src="<?php echo IMAGE_PATH . DS; ?>cross.png" alt="<?php echo $language->translate("remove_frame"); ?>" /></a><br />
<?php if ($owns) {

?>
                                <a href="mylinks.php?action=edit&lid=<?php echo $lid; ?>&sid=<?php echo $sid; ?>" title="<?php echo $language->translate("title_edit_link"); ?>"><?php echo $language->translate("table_edit"); ?></a><br />
                                <a href="mylinks.php?action=delete&lid=<?php echo $lid; ?>&sid=<?php echo $sid; ?>" title="<?php echo $language->translate("title_remove_link"); ?>"><?php echo $language->translate("table_remove"); ?></a>
<?php

                            }
                            else {

?>
                                <a href="report.php?action=report&id=<?php echo $lid; ?>&sid=<?php echo $sid; ?>" title ="<?php echo $language->translate("report_link_expired"); ?>"><?php echo $language->translate("report"); ?></a><br />
<?php } ?>
                            </div>
<?php echo $language->translate("no_definitions_found"); ?><span id="link_nh_visit"><?php echo "http://" . $_SERVER['HTTP_HOST'] . "/visit.php?id=" . $lid; ?></span><br />
                            <?php echo $language->translate("label_destination"); ?><span id="link_dest_visit"><?php echo $temp->destination; ?></span><br />
                            <?php echo $language->translate("label_description"); ?><span id="link_desc_visit"><?php echo $temp->description; ?></span><br />
                            <?php echo $language->translate("label_last_modified"); ?><span id="lastmod_visit"><?php echo $temp->lastmod; ?></span>
                            </div>
                        </td>
                    </tr>
                    <tr id="destino">
                        <td><iframe id="dest_frame" frameborder="0" src="<?php echo $temp->destination; ?>"></iframe></td>
                    </tr>
                </table>
            </div>
        </body>
</html>
<?php

                            }
                            else {
                                // There id, but est disabled or does not exist
                                header('Location: index.php');
                            }
                        }

?>