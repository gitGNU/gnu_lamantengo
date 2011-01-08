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

    $title = $language->translate("title_logout");

    $errors = "";

    if (!$user->isUserLoggedIn()) { // Not logged in
        $errors .= $language->translate("error_already_loggedout");
    }
    else {
        $user->logoutUser();
    }
    include("header.php");

?>
<div id="contents">
    <?php

        if ($errors)
            echo "<div id=\"errores\">$errors</div>";
        else
            echo $language->translate("session_closed");

    ?>
        </div>
<?php

        include("footer.php");

?>