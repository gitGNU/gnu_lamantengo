<?php

    /**
     * @License(name="GNU General Public License", version="3.0")
     *
     * Copyright (C) 2010 UnWebmaster.Com.Ar
     * Copyright (C) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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

    $title = $language->translate("title_report");

    $errors = "";
    $success = "";
    $formreport = 0;

    function comprobar_email($address) {
        if (function_exists('filter_var')) {
            if (filter_var($address, FILTER_VALIDATE_EMAIL) === FALSE) {
                return false;
            }
            else {
                return true;
            }
        }
        else {
            return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $address);
        }

    }

    if ($_GET['action']) {
        if ($_GET['action'] == 'report') {
            // is to report
            if ($lid = $_GET['id']) {
                // LID there, so good
                $query = "SELECT `uid`,`destination` FROM `links` WHERE `lid`='$lid' AND `active`='1' LIMIT 1;";
                $rs = mysql_query($query);
                if (($temp = mysql_fetch_object($rs)) == null) {
                    // there is no link / is inactive
                    $errors .= $language->translate("error_link_not_exist");
                }
                else {
                    if (($uid == $temp->uid) || ($temp->uid == 0)) {
                        $errors .= $language->translate("error_link_public") . "<a href=\"mylinks.php?action=edit&lid=$lid\">" . $language->translate("error_click_here");
                    }
                    else {
                        if ($_POST) {
                            // There POST, and sent the report. check it is correct
                            if ($_POST['destination'] != null) {
                                $parts = @parse_url($_POST['destination']);
                                if ($parts['scheme'] == '')
                                    $errors .= $language->translate("error_incomplete_url");
                            }
                            if (!$uid) {
                                if ($_POST['realname'] == "") {
                                    $errors .= $language->translate("error_must_enter_name");
                                }
                                if ($_POST['email'] == "") {
                                    $errors .= $language->translate("error_must_enter_email");
                                }
                                else {
                                    if (!comprobar_email($_POST['email'])) {
                                        $errors .= $language->translate("error_email_invalid");
                                    }
                                }
                            }
                            $report = $_POST['report'];
                            if ($errors == null) {// correct report, sent it / put pending
                                if ($uid) {
                                    // is logged, the mail command
                                    /** @TODO: grab recipient data and report, prepare the mail message, and send it * */
                                    /*                                     * $query="SELECT uid,username,email,realname,active FROM users WHERE uid = $uid AND active = 1 LIMIT 1'";
                                      $rs = mysql_query ($query);
                                      if ($fila = mysql_fetch_object ($rs)){
                                      $realname = $fila ->realname;
                                      $username = $fila ->username;
                                      $mail_enviar_a =
                                      include('email_report.php');
                                      $success="Reporte enviado";
                                      $success.=$mail_cuerpo;
                                      }else{
                                      $errors.="Usuario incorrecto<br />";
                                      } */
                                }
                                else {
                                    // not logged in, put pending verification and control
                                    // Prepare the key
                                    list($usec, $sec) = explode(' ', microtime());
                                    $seed = (float) $sec + ((float) $usec * 100000);
                                    srand($seed);
                                    $key = md5(uniqid(rand(), 1));
                                    $seed = null;
                                    // Order to prepare the key
                                    $query = "INSERT INTO `reports` (`key`,`realname`,`email`,`lid`,`destination`,`comment`,`active`) VALUES ('$key','" . $_POST['realname'] . "','" . $_POST['email'] . "','$lid','" . $_POST['destination'] . "','" . $_POST['report'] . "','1');";
                                    $rs = mysql_query($query);
                                    $rid = mysql_insert_id();
                                    /*                                     * ************************************************************************mail(verificacion de reporte);************************* */
                                    $key = "";
                                    $success = $language->translate("email_verify");
                                }
                            }
                            else {
                                // Invalid report, there were errors. ask show report form
                                $formreport = 1;
                            }
                        }
                        else {
                            // no post, I show user form to enter report
                            $formreport = 1;
                        }
                    }
                }
            }
            else {
                // No lid. throw error
                $errors .= $language->translate("error_link_id_empty");
            }
        }
        else {
            // action is not "report"
            if ($_GET['action'] == 'confirm') {
                // user confirms a report
                if ((($key = $_GET['key']) != "") && (($rid = $_GET['id']) != "")) {
                    // reporting is key. check that is valid
                    $query = "SELECT `lid`,`realname`,`email`,`destination`,`comment` FROM `reports` WHERE `rid`='$rid' AND `key`='$key' AND `active`='1' LIMIT 1;";
                    $rs = mysql_query($query);
                    if (($temp = mysql_fetch_object($rs)) == null) {
                        // the key does not exist
                        $errors .= $language->translate("error_key_invalid");
                    }
                    else {
                        // valid key, sending the mail to report to the owner of the link, turn off the slope and informed that the report is sent
                        $mail_es_usuario = 0;
                        $realname = $temp->realname;
                        $id_link = $temp->lid;
                        $mail_detination = $temp->destination;
                        $mail_dice = $temp->comment;
                        $mail_enviar_a = $temp->email;
                        include('email_report.php');
                        $success = $language->translate("report_sent");
                        $query = "UPDATE `reports` SET `active`='0' WHERE `rid`='$rid' LIMIT 1;";
                        $rs = mysql_query($query);
                        if (!mysql_affected_rows())
                            $errors .= $language->translate("error_modify_report");
                    }
                }else {
                    // reporting no key.
                    $errors .= $language->translate("error_empty_report");
                }
            }
            else {
                // Action is no report or confirm. I fruit. will throw error.
                $errors .= $language->translate("error_invalid_action");
            }
        }
    }
    else {
        // No action. throw error
        $errors .= $language->translate("error_nothing_to_do");
    }
    include('header.php');

?>
<div id="contents">
    <?php

        if ($success) {

    ?>
            <div id="success"><?php echo $success; ?></div>
    <?php

        }
        if ($errors) {

    ?>
            <div id="errores"><?php echo $errors; ?></div>
    <?php

        }
        if ($formreport) {

    ?>
            <div id="form_reg">
                <form action="?action=report&id=<?php echo $lid; ?>" method="POST">
                    <table id="table_reg">
                <?php

                    if (!$uid) {

                ?>
                        <tr id="tr_reg">
                            <td id="td_reg1"><?php echo $language->translate("first_name_label"); ?></td>
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
                        <td id="td_reg2"><a href="visit.php?id=<?php echo $lid; ?>">http://www.lamantengo.com.ar/visit.php?id=<?php echo $lid; ?></a></td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1"><?php echo $language->translate("suggested_target"); ?></td>
                        <td id="td_reg2"><input type="text" name="destination" size="35" value="<?php echo $_POST['destination']; ?>" /></td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1"><?php echo $language->translate("comment"); ?></td>
                        <td id="td_reg2"><textarea name="report" cols="40" rows="10"><?php echo $_POST['report']; ?></textarea></td>
                    </tr>
                <?php

                    if (!$uid) {

                ?>
                        <tr id="tr_reg">
                            <td colspan="2"><?php include('recaptcha_form.php'); ?></td>
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