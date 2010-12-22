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

    $title = $language->translate("title_forgot");

    $errores = "";
    if ($uid) { // already logged in
        $errores .= $language->translate("error_already_loggedin");
    }
    else { // Not logged. I look if I'm dating or not
        if ($_POST) { // Came in POST data, bone, and put the username / email
            if ($_POST['username'] == "") {
                $errores .= $language->translate("error_username");
                $username = "";
            }
            else {
                $username = $_POST['username'];
            }
            if ($_POST['email'] == "") {
                $errores .= $language->translate("error_email_empty");
            }
            else {
                $email = $_POST['email'];
            }
            /*             * *********************** recaptcha check **************************************
              include('recaptcha_check.php');
              /********************** recaptcha check order ************************************* */
            if (!($errores)) {
                $query = "SELECT uid,username,email,realname,active FROM users WHERE LOWER(username) ='" . strtolower($username) . "' AND email='" . strtolower($email) . "'";
                $rs = mysql_query($query);
                if ($fila = mysql_fetch_object($rs)) { // matches users and mail ... new genus pass, and sent him
                    if (!$fila->active) {
                        $errores .= $language->translate("error_user_disabled");
                        $_POST['email'] = "";
                        $_POST['username'] = "";
                    }
                    else {
                        $uid = $fila->uid;
                        $username = $fila->username;
                        $email = $fila->email;
                        $realname = $fila->realname;
                        include("generar_password.php");
                        $password = generar_pass();
                        include("email_forgot.php");
                        $password = md5($password);
                        $query = "UPDATE `users` SET `password`='$password' WHERE `uid`=$uid;";
                        $password = "";
                        $rs = mysql_query($query);
                        if ($errores)
                            $success = $cuerpo;
                        else
                            $success = $language->translate("password_updated");
                        $uid = "";
                        $username = "";
                        $realname = "";
                        $email = "";
                    }
                }else {
                    $errores .= $language->translate("error_email_nomatch");
                }
            }
        }
        // If you come here, or did not get data, or there were errors. Show form
        include("header.php");

?>
        <div id="contenido">
    <?php

        if ($errores) {

    ?>
            <div id="errores">
        <?php echo $errores; ?>
        </div>
    <?php

        }
        if ($success) {

    ?>
            <div id="success">
        <?php echo $success; ?>
        </div>
    <?php

        }

    ?>
        <div id="form_reg">
            <form action="forgot.php" method="POST">
                <table id="table_reg">
                    <tr id="tr_reg">
                        <td id="td_reg1">User*:</td>
                        <td id="td_reg"><input id="text_reg" type="text" name="username" value="<?php echo $username; ?>" /></td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1">Email*:</td>
                        <td id="td_reg"><input id="text_reg" type="text" name="email" value="<?php echo $email; ?>" /></td>
                    </tr>
                    <!--<tr id="tr_reg">
                            <td colspan="3"><?php include('recaptcha_form.php'); ?></td>
        							</tr>!-->
                    <tr>
                        <td colspan="3">
                            <input type="submit" id="submit_reg" value="<?php echo $language->translate("reset_password"); ?>" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div id="explanation">
    <?php

        echo $language->translate("reset_explanation");
        echo "</div>";

        include("footer.php");
    }

    ?>