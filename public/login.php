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

    $title = $language->translate("title_login");
    $errors = "";

    if ($user->isUserLoggedIn()) { // Already logged in
        $errors .= $language->translate("error_loggedin");
    }
    else { // Not logged in
        if ($_POST['login']) {

            //if ($_POST['login']) { // POST data
            // prepare data for database
            $username = $database->escapeValue($_POST['user']);
            $password = $database->escapeValue($_POST['password']);

            if ($username == "") {
                $errors .= $language->translate("error_username_empty");
            }
            if ($password == "") {
                $errors .= $language->translate("error_password_empty");
            }
            if (!($errors)) {
                $user_id = $user->authenticateUser($username, $password);

                if ($user_id != null && $user_id != '') {
                    $user->loginUser($user_id);

                    if ($user->getIsUserActive() == FALSE)
                        $errors .= $language->translate("error_user_disabled");
                    else {

                        // Update the sid in the database session table
                        $session->updateSession();

                        $success = $language->translate("login_welcome");
                        $success .= $language->translate("login_redirect");
                        $success .="<meta http-equiv=\"refresh\" content=\"3,index.php\" />";
                    }
                }
                else {
                    $errors .= $language->translate("error_unknown_user");
                }
            }
        }

        // Show form
        include("header.php");

?>
        <div id="contenido">
    <?php if ($errors) {

    ?>
            <div id="errores"><?php echo $errors; ?></div>
    <?php

        }
        if ($success) {

    ?>
            <div id="success"><?php echo $success; ?></div>
    <?php

        }
        else {

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