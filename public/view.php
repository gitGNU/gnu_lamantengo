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

    $title = $language->translate("title_view");

    $errors = "";
    $id = $_GET['id'];
    if (!$id) {
        $errors .= $language->translate("error_no_link_id");
    }
    else {
        // ID exists - get data

        $link = new Link();

        $data = $link->getLinkDataSetByID($id);


        if (empty($data)) {
            $errors .= $language->translate("error_link_noexistent");
        }
        else {
            $destination = $data['destination'];
            $description = $data['description'];
            $lastmod = $data['lastmod'];
            $visits = $data['visits'];
            $uid = $data['uid'];
        }
    }
    include('header.php');

?>
<div id="contenido">
    <h2><?php echo $title; ?></h2>
<?php

    if ($errors) {

?>
        <div id="errores"><?php echo $errors; ?></div>
    <?php

    }
    else {
        if ($_GET['new']) {

    ?>
            <div id="success"><?php $language->translate("success_link_added"); ?></div>
<?php

        }

?>
        <div id="view">
            <table id="table_view">
                <tr>
                    <td class="headers_view" width="35%">Link LaMantengo:</td>
                    <td class="data_view">http://<?php echo $_SERVER['HTTP_HOST']; ?>/visit.php?id=<?php echo $id; ?></td>
                </tr>
                <tr>
                    <td class="headers_view"><?php echo $language->translate("label_destination"); ?></td>
                    <td class="data_view"><a href="visit.php?id=<?php echo $id; ?>" target="_blank"><?php echo $destination; ?></a></td>
            </tr>
            <tr>
                <td class="headers_view"><?php echo $language->translate("label_description"); ?></td>
                <td class="data_view"><?php echo $description; ?></td>
            </tr>
            <tr>
                <td class="headers_view"><?php echo $language->translate("label_last_modified"); ?></td>
                <td class="data_view"><?php echo $lastmod; ?></td>
            </tr>
<?php

            if (($uid == $user->getUserID()) || ($uid == 0)) { // if you own

?>
                <tr>
                    <td class="headers_view"><?php echo $language->translate("label_visits"); ?></td>
                    <td class="data_view"><?php echo $visits; ?></td>
                </tr>
                <tr id="imglink">
                    <td colspan="2" align="center" id="imglink">
                        <a href="mylinks.php?action=edit&lid=<?php echo $id; ?>" id="imglink" title="<?php echo $language->translate("table_edit"); ?>"><img src="<?php echo IMAGE_PATH . DS; ?>edit.png" id="imglink" /><?php echo $language->translate("table_edit"); ?></a>
                                <a href="mylinks.php?action=delete&lid=<?php echo $id; ?>" title="<?php echo $language->translate("table_remove"); ?>" id="imglink"><img src="<?php echo IMAGE_PATH . DS; ?>delete.png" id="imglink" /><?php echo $language->translate("table_remove"); ?></a>
                            </td>
                        </tr>
    <?php

            }

    ?>
                </table>
            </div>
            <div id="explanation">
<?php echo $language->translate("view_explanation"); ?>
            </div>
<?php

        }
        echo "</div>";
        include("footer.php");

?>