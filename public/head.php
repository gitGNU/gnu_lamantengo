<?php
    /**
     * @License(name="GNU General Public License", version="3.0")
     *
     * Copyright (C) 2010 UnWebmaster.Com.Ar
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
    if (defined('INSITE')) {
?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ar" xml:lang="es-ar">
            <head>
                <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
                <meta http-equiv="content-style-type" content="text/css" />
                <meta http-equiv="content-language" content="es-ar" />
                <meta http-equiv="imagetoolbar" content="yes" />
                <meta name="resource-type" content="document" />
                <meta name="distribution" content="global" />
                <meta name="copyright" content="2010 LaMantengo.Com.Ar" />
                <meta name="keywords" content="" />
                <meta name="description" content="" />
                <link href="style.css" rel="stylesheet" type="text/css" />
                <title><?php echo $title; ?> - LaMantengo</title>
            </head>
            <body class="cuerpo" bgcolor="#DDFFDD">
                <div id="logo"><a href="index.php
            <?php
                if ($sid) {
                    echo "?sid=" . $sid;
                }
            ?>
                              " id="logo" title="NoHuyas.Com.Ar"><img src="<?php echo IMAGE_PATH . DS; ?>logo.png" alt="NoHuyas.Com.Ar" /></a>
            </div>
            <div id="inter">English | Spanish</div>

            <div id="reging"><?php include("reging.php"); ?></div>
        <?php
            }
            else {
                include("404.php");
            }
        ?>