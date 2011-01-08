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

    $title = $language->translate("terms_of_service_link");

    include('header.php');

?>
<div id="contents">    
        <div id="tos">
            <h2><?php echo $language->translate("terms_and_conditions"); ?></h2>
            <h3><?php echo $language->translate("introduction"); ?></h3>
            <p>
            <?php echo $language->translate("tos_text"); ?>
            </p>
            <h3><?php echo $language->translate("full_text"); ?></h3>
            <p><?php echo $language->translate("pending"); ?></p>
        </div>
</div>
<?php

                include("footer.php");

?>