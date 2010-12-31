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

    $title = $language->translate("title_mylinks");

    $errores = "";
    $success = "";
    $formedit = 0;
    $captcha = 0;
    if ($_GET['action']) {
        if ($_GET['action'] == 'edit') {
            if ($_POST != null) {
                $parts = @parse_url($_POST['destination']);
                if ($parts['scheme'] == '')
                    $errores .= $language->translate("error_incomplete_url");
                if (!($lid = $_POST['lid']))
                    $errores .= $language->translate("error_link_empty");
                if (!$uid) {
                    /*                     * *********************** recaptcha check **************************************
                      include('recaptcha_check.php');
                      /**********************fin recaptcha check ************************************* */
                }
                if ($errores == null) {
                    $query = "UPDATE `links` SET `destination`='" . $_POST['destination'] . "', `description`='" . $_POST['description'] . "' WHERE `lid`='$lid' AND (`uid`='$uid' OR `uid`='0') AND `active`='1' LIMIT 1;";
                    $rs = mysql_query($query);
                    if (mysql_affected_rows ())
                        $success = $language->translate("success_updated");
                    else
                        $errores .= $language->translate("error_nopermission");
                }else {
                    $formedit = 1;
                }
            }
            else {
                if ($lid = $_GET['lid']) {
                    if ($uid) {
                        $query = "SELECT `destination`,`description`,`lastmod` FROM `links` WHERE `active`='1' AND (`uid`='$uid' OR `uid`='0') AND `lid`='$lid' LIMIT 1;";
                    }
                    else {
                        $query = "SELECT `destination`,`description`,`lastmod` FROM `links` WHERE `active`='1' AND `uid`='0' AND `lid`='$lid' LIMIT 1;";
                    }
                    $rs = mysql_query($query);
                    if ($temp = mysql_fetch_object($rs)) {
                        $destination = $temp->destination;
                        $description = $temp->description;
                        $lastmod = $temp->lastmod;
                        $formedit = 1;
                        /*                         * if(!$uid)
                          $captcha=1;* */
                    }
                    else {
                        $errores .= $language->translate("error_nopermission");
                    }
                }
                else {
                    $errores .= $language->translate("error_link_empty");
                }
            }
        }
        else {
            if ($_GET['action'] == 'delete') {
                if ($_POST) { // remove many links together since mylinks.php
                    if (!($uid))
                        $errores .= $language->translate("error_mass_removal");
                    else {
                        foreach ($_POST as $key => $value) {
                            $query = "UPDATE `links` SET `active`='0' WHERE `lid`='$key' AND (`uid`='$uid' OR `uid`='0') AND `active`='1' LIMIT 1;";
                            $rs = mysql_query($query);
                            if (mysql_affected_rows ())
                                $success .= $language->translate("success_link_removed");
                            else
                                $errores .= $language->translate("error_no_edit_permission");
                        }
                    }
                }else {
                    if ($lid = $_GET['lid']) { //elimino un unico link (por get)
                        if ($uid)
                            $query = "UPDATE `links` SET `active`='0' WHERE `lid`='$lid' AND (`uid`='$uid' OR `uid`='0') AND `active`='1' LIMIT 1;";
                        else
                            $query="UPDATE `links` SET `active`='0' WHERE `lid`='$lid' AND `uid`='0' AND `active`='1' LIMIT 1;";
                        $rs = mysql_query($query);
                        if (mysql_affected_rows ())
                            $success = $language->translate("success_link_removed");
                        else
                            $errores .= $language->translate("error_no_edit_permission");
                    }else {
                        $errores .= $language->translate("error_no_link_id");
                    }
                }
            }
            else {
                $errores .= $language->translate("error_invalid_action");
            }
        }
    }
    else {
        if (!$user->isUserLoggedIn()) { // User not logged in
            // not logged in
            $errores .= $language->translate("error_not_loggedin_links");
        }
    }
    if ($user->isUserLoggedIn()) { // User is logged in
        $query = "SELECT `lid`, `destination`, `description`, `lastmod`, `visits` FROM `links` WHERE `uid`='$uid' AND `active`='1';";
        $rs_links = mysql_query($query);
        if (mysql_errno ())
            $errores .= $language->translate("error_failed_database_conn");
    }
    include('header.php');

?>
<div id="contenido">
    <h2><?php echo $title; ?></h2>
    <?php

        if ($success) {

    ?>
        <div id="success">
    <?php echo $success; ?>
            </div>
    <?php

        }
        if ($errores) {

    ?>
            <div id="errores">
<?php echo $errores; ?>
            </div>
<?php

        }
        if ($formedit) {

?>
            <div id="formedit">
                <form action="?action=edit&sid=<?php echo $sid; ?>" method="POST">
                    <input type="hidden" name="lid" value="<?php echo $lid; ?>" />
                    <table id="table_edit">
                        <tr id="tr_table_edit">
                            <td id="td1_table_edit">Link LaMantengo:</td>
                            <td id="td2_table_edit"><a href="visit.php?id=<?php echo $lid . "&sid=$sid"; ?>">http://www.lamantengo.com.ar/visit.php?id=<?php echo $lid; ?></a></td>
                        </tr>
                        <tr id="tr_table_edit">
                            <td id="td1_table_edit"><?php echo $language->translate("label_destination"); ?></td>
                            <td id="td2_table_edit"><input type="text" name="destination" value="<?php echo $destination; ?>" id="input_dest_table_edit" size="40" /></td>
                        </tr>
                        <tr id="tr_table_edit">
                            <td id="td1_table_edit"><?php echo $language->translate("label_description"); ?></td>
                            <td id="td2_table_edit"><textarea name="description" cols="40" rows="3"><?php echo $description; ?></textarea></td>
                        </tr>
                        <tr id="tr_table_edit">
                            <td id="td1_table_edit"><?php echo $language->translate("label_last_modified"); ?></td>
                            <td id="td2_table_edit"><?php echo $lastmod; ?></td>
                        </tr>
                        <tr id="tr_table_edit">
                            <td colspan="2"><input type="submit" value="<?php echo $language->translate("save_changes"); ?>" id="submit_edit" /> <input type="reset" value="<?php echo $language->translate("reset_button"); ?>" id="reset_edit" /></td>
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
                    <td id="links_head_td"><?php echo $language->translate("table_destination"); ?></td>
                    <td id="links_head_td">Link</td>
                    <td id="links_head_td"><?php echo $language->translate("table_description"); ?></td>
                    <td id="links_head_td"><?php echo $language->translate("table_round"); ?></td>
                    <td id="links_head_td"><?php echo $language->translate("table_edit"); ?></td>
                    <td id="links_head_td"><?php echo $language->translate("table_remove"); ?></td>
                    <td id="links_head_td"><?php echo $language->translate("table_last_modified"); ?></td>
                </tr>
                <?php

                    while (($temp = @mysql_fetch_object($rs_links)) != null) {

                ?>
                        <tr id="links_tr">
                            <td id="chk_td_links"><input type="checkbox" name="<?php echo $temp->lid; ?>" id="chk_links" /></td>
                            <td id="dest_td_links"><a href="view.php?id=<?php echo $temp->lid . "&sid=" . $sid; ?>" target="_blank" title="<?php echo $language->translate("title_link_new_window"); ?>"><?php echo $temp->destination; ?></a></td>
                            <td id="link_td_links"><a href="visit.php?id=<?php echo $temp->lid . "&sid=" . $sid; ?>" title="Ver link"><img src="<?php echo IMAGE_PATH . DS; ?>link.png" title="Link LaMantengo" alt="Link LaMantengo" /></a></td>
                            <td id="desc_td_links"><?php echo $temp->description; ?></td>
                            <td id="visits_td_links"><?php echo $temp->visits; ?></td>
                            <td id="edit_td_links"><a href="?action=edit&lid=<?php echo $temp->lid . "&sid=$sid"; ?>" title="<?php echo $language->translate("table_edit"); ?>"><img src="<?php echo IMAGE_PATH . DS; ?>edit.png" alt="<?php echo $language->translate("table_edit"); ?>" title="<?php echo $language->translate("table_edit"); ?>" /></a></td>
                            <td id="delete_td_links"><a href="?action=delete&lid=<?php echo $temp->lid . "&sid=$sid"; ?>" title="<?php echo $language->translate("table_remove"); ?>"><img src="<?php echo IMAGE_PATH . DS; ?>delete.png" alt="<?php echo $language->translate("table_remove"); ?>" title="<?php echo $language->translate("table_remove"); ?>" /></a></td>
                                        <td id="lastmod_td_links"><?php echo $temp->lastmod; ?></td>
                                    </tr>
<?php

                    }

?>
                                    <tr id="links_tr_head">
                                        <td colspan="6" id="submit_td_links">&nbsp;</td>
                                    </tr>
                                    <tr id="links_tr_head">
                                        <td colspan="6" id="submit_td_links"><input type="submit" id="submit_links" value="<?php echo $language->translate("delete_selected"); ?>" /></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div id="explanation">
<?php echo $language->translate("click_button"); ?> <img src="images/edit.png" alt="<?php echo $language->translate("table_edit"); ?>" title="<?php echo $language->translate("table_edit"); ?>" /> <?php echo $language->translate("inst_change_dest"); ?> <img src="<?php echo IMAGE_PATH . DS; ?>delete.png" alt="<?php echo $language->translate("table_edit"); ?>" title="<?php echo $language->translate("table_edit"); ?>" /> <?php echo $language->translate("inst_remove"); ?>
<?php echo $language->translate("inst_bulk_remove"); ?>
                    </div>
<?php

                    include("footer.php");

?>