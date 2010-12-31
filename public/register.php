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

    $title = $language->translate("title_register");
    $errores = "";

    if (!$user->isUserLoggedIn()) { // not logged in
        if ($_POST) { // Process form data
            $username = $database->escapeValue($_POST['username']);
            $realname = $database->escapeValue($_POST['realname']);
            $email = $database->escapeValue($_POST['email']);
            $email2 = $database->escapeValue($_POST['email2']);
            $agree = $database->escapeValue($_POST['agree']);

            // look for errors and methodological errors as listed in $errores
            if (!($agree))
                $errores .= $language->translate("error_agree");
            if ($username == "")
                $errores .= $language->translate("error_username");
            else
            if (strlen($username) < 4)
                $errores .= $language->translate("error_size");
            if ($email == "")
                $errores .= $language->translate("error_email_empty");
            else {
                $email = strtolower($email);
                $email2 = strtolower($email2);
                if ($email != $email2)
                    $errores .= $language->translate("error_email_nomatch");
                else
                if (!($user->validate_email($email)))
                    $errores .= $language->translate("error_email_invalid");
            }
            /*             * *********************** chequeo recaptcha **************************************
              include('recaptcha_check.php');
              /**********************fin chequeo recaptcha ************************************* */
            if (!$errores) { // no errors
                /*                 * ***********************************************************************************
                 * * NO USO ESTO. VERIFICO EL EMAIL MEDIANTE EL ENVIO DEL PASSWORD
                 * * //Genero un activation_key completamente random (Sacado de Coppermine 1.4.19 - register.php:261-264)
                 * * list($usec, $sec) = explode(' ', microtime());
                 * * $seed = (float) $sec + ((float) $usec * 100000);
                 * * srand($seed);
                 * * $act_key = md5(uniqid(rand(), 1));
                  //Fin Genero activation_key
                 * ************************************************************************************* */
                $password = $user->generatePassword();
                $pass_hash = md5($password);

                $result = $user->registerUser($username, $realname, $email, $pass_hash);

                if (mysql_errno() == 1062)
                    $errores .= $language->translate("error_already_registered");
                if (!$errores) {

//                    // activation and concatenate shipping errors
//                    $query = "SELECT `uid` FROM `users` ORDER BY `uid` DESC LIMIT 0 , 1;";
//                    $rs = mysql_query($query);
//                    $temp = mysql_fetch_object($rs);
//                    $uid = $temp->uid;

                    include("email_register.php");

                    $password = "";
                    $uid = "";
                    if (!$errores) {
                        $success = $language->translate("registered_successfully");
                    }
                    else {
                        $success = $mail_cuerpo . $language->translate("important_message");
                    }
                }
            }
        } // END POST
    }
    else { // User logged in
        $errores .= $language->translate("error_already_reg");
    }

    // show page
    require_once('header.php');

?>
<div id="contenido">
    <?php

        if ($errores) {

    ?>
            <div id="errores"><?php echo $errores; ?></div>
    <?php

        }
        if ($success) {

    ?>
            <div id="success"><?php echo $success; ?></div>
    <?php

        }

    ?>
        <div id="form_reg">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?language=es&country=ar'; ?>" method="POST">
                <table id="table_reg">
                    <tr id="tr_reg">
                        <td id="td_reg1">User*:</td>
                        <td id="td_reg"><input id="text_reg" type="text" name="username" value="<?php echo $_POST['username']; ?>" /></td>
                        <td id="td_reg2"><?php echo $language->translate("username_message"); ?></td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1"><?php echo $language->translate("first_name_label"); ?></td>
                        <td id="td_reg"><input id="text_reg" type="text" name="realname" value="<?php echo $_POST['realname']; ?>" /></td>
                        <td id="td_reg2"><?php echo $language->translate("first_name_message"); ?></td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1">Email*:</td>
                        <td id="td_reg"><input id="text_reg" type="text" name="email" value="<?php echo $_POST['email']; ?>" /></td>
                        <td id="td_reg2"><?php echo $language->translate("email_message"); ?></td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1"><?php echo $language->translate("email_repeat_label"); ?></td>
                        <td id="td_reg"><input id="text_reg" type="text" name="email2" value="<?php echo $_POST['email2']; ?>" /></td>
                        <td id="td_reg2"><?php echo $language->translate("email_repeat_message"); ?></td>
                    </tr>
                <?php /* <tr id="tr_reg">
                      <td id="td_reg1">Password*:</td>
                      <td id="td_reg"><input id="pass_reg" type="password" name="password" value="" /></td>
                      <td id="td_reg2">(6 caracteres m&iacute;nimo)</td>
                      </tr>
                      <tr id="tr_reg">
                      <td id="td_reg1">Repite password*:</td>
                      <td id="td_reg"><input id="pass_reg" type="password" name="pass2" value="" /></td>
                      <td id="td_reg2">(para evitar errores de tipeo)</td>
                      </tr>
                      <tr id="tr_reg">
                      <td colspan="2"><?php include('recaptcha_form.php'); ?></td>
                      <td id="td_reg2">Ingrese las dos palabras para evitar registros automatizados (y <a href="visit.php?id=33<?php if($sid) echo "&sid=$sid";?>" title="Leer sobre ReCaptcha y la digitalizaci&oacute;n de libros" target="_blank">ayudar a digitalizar libros</a>)</td>
                      </tr> */ ?>
                    <tr>
                        <td colspan="3" id="td_check_reg">
                            <input name="agree" type="checkbox" title="<?php echo $language->translate("title_agreeToS"); ?>" /> <?php echo $language->translate("accept_agree_label"); ?> <a href="tos.php?sid=<?php echo $sid; ?>" title="<?php echo $language->translate("title_read_ToS"); ?>"><?php echo $language->translate("terms_of_service_link"); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" id="submit_reg" value="<?php echo $language->translate("register_button"); ?>" />
                            <input type="reset" id="reset_reg" value="<?php echo $language->translate("reset_button"); ?>" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>
<div id="explanation">
    <?php echo $language->translate("reg_instruct"); ?> title="<?php echo $language->translate("read_ToS_nWindow"); ?>"><?php echo $language->translate("terms_of_service_link"); ?></a>.
                </div>
<?php

                    include("footer.php");

?>