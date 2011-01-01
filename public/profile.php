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

    $title = $language->translate("title_profile");

    $errors = ""; // void error
    $muestro_formulario = 1;
    if ($user->isUserLoggedIn()) { // user is logged in
        if ($_POST) { // Process form data
            $realname = $_POST['realname'];
            $new_pass = $_POST['new_pass'];
            $_POST['new_pass'] = "";
            $new_pass2 = $_POST['new_pass2'];
            $_POST['new_pass2'] = "";
            $password = md5($_POST['password']);
            $_POST['password'] = "";
            // look for errors and methodological errors as listed in $errors
            if ($new_pass != "") {
                if ($new_pass2 == "")
                    $errors .= $language->translate("error_confirm_pass_empty");
                else
                if ($new_pass != $new_pass2)
                    $errors .= $language->translate("error_passwords_nomatch");
                else {
                    $new_pass2 = "";
                    if (strlen($new_pass) < 6)
                        $errors .= $language->translate("error_password_tooshort");
                    else
                    if (!(preg_match('/^[a-zA-Z0-9\.\(\)\-\_\!\@\=]{6,20}/', $new_pass))) {
                        $errors .= $language->translate("error_password_6_20_long");
                        $errors .= "<b>(</b> <b>)</b> <b>-</b> <b>_</b> <b>!</b> <b>@</b> <b>=</b><br />\n";
                    }
                    else { // no password error
                        $new_pass = md5($new_pass);
                    }
                }
            }
            if (!$errors) {
                $query = "SELECT `active` FROM `users` WHERE `uid`='$uid' AND `password`='$password';";
                $rs = mysql_query($query);
                if (!($fila = mysql_fetch_object($rs)))
                    $errors .= $language->translate("error_password_incorrect");
                else {
                    if (!($fila->active))
                        $errors .= $language->translate("error_user_disabled");
                }
                if (!$errors) {
                    // update data
                    $query = "UPDATE `users` SET ";
                    if ($new_pass)
                        $query.="`password`='$new_pass', ";
                    $query.="`realname`='$realname' WHERE `uid`='$uid';";
                    $rs = mysql_query($query);
                    $success = $language->translate("profile_updated");
                }
            }
        } // END POST
    }else { // User not logged
        $errors .= $language->translate("error_login_to_view_profile");
        $muestro_formulario = 0;
    }
// Show page with errors or success whichever is applicable
    include('header.php');

?>
<div id="contenido">
    <?

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
        if ($muestro_formulario) {

?>
            <div id="form_reg">
                <form action="?sid=<?php echo $sid; ?>" method="POST">
                    <table id="table_reg">
                        <tr id="tr_reg">
                            <td id="td_reg1">User:</td>
                            <td id="td_reg"><b><?php echo $username; ?></b></td>
                            <td id="td_reg2">&nbsp;</td>
                        </tr>
                        <tr id="tr_reg">
                            <td id="td_reg1">Email:</td>
                            <td id="td_reg"><?php echo $email; ?></td>
                            <td id="td_reg2">&nbsp;</td>
                        </tr>
                        <tr id="tr_reg">
                            <td id="td_reg1"><?php echo $language->translate("first_name_label"); ?></td>
                            <td id="td_reg"><input id="text_reg" type="text" name="realname" value="<?php echo $realname; ?>" /></td>
                            <td id="td_reg2"><?php echo $language->translate("first_name_message"); ?></td>
                        </tr>
                        <tr id="tr_reg">
                            <td id="td_reg1"><?php echo $language->translate("new_password_label"); ?></td>
                            <td id="td_reg"><input id="pass_reg" type="password" name="new_pass" value="" /></td>
                            <td id="td_reg2"><?php echo $language->translate("message_6_20_char"); ?></td>
                        </tr>
                        <tr id="tr_reg">
                            <td id="td_reg1"><?php echo $language->translate("message_repeat_password"); ?></td>
                            <td id="td_reg"><input id="pass_reg" type="password" name="new_pass2" value="" /></td>
                            <td id="td_reg2"><?php echo $language->translate("message_symbols"); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                &nbsp;
                            </td>
                        </tr>
                        <tr id="tr_reg">
                            <td id="td_reg1"><?php echo $language->translate("label_current_password"); ?></td>
                            <td id="td_reg"><input id="pass_reg" type="password" name="password" value="" /></td>
                            <td id="td_reg2"><?php echo $language->translate("confirm_changes"); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="submit" id="submit_reg" value="<?php echo $language->translate("btn_edit_profile"); ?>" />
                                <input type="reset" id="reset_reg" value="<?php echo $language->translate("reset_button"); ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
<?php } ?>
        </div>
        <div id="explanation">
<?php

        echo $language->translate("profile_explanation");

?>
        </div>
<?php

        include("footer.php");

?>