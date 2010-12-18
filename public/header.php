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

if (($_GET['language'] == 'en') || ($_GET['language'] == 'es')) {
    $language->setLocale($_GET['language'], $_GET['country']);
}

if (defined('INSITE')) {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ar" xml:lang="es-ar">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta http-equiv="Content-Style-Type" content="text/css" />
            <meta http-equiv="Content-Language" content="es-ar" />
            <meta name="description" content="Generador de links con destino modificable" />
            <link href="../includes/styles/style.css" rel="stylesheet" type="text/css" />
            <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

            <title><?php echo $title; ?> - LaMantengo</title>
        </head>
        <body class="cuerpo" bgcolor="#DDFFDD">
            <div id="upperLeftDiv"><a href="index.php<?php if ($sid)
        echo "?sid=" . $sid; ?>"><img src="<?php echo IMAGE_PATH . DS; ?>home.png" alt="Go to home" title="Go to home" /></a>
        </div>
        <div id="inter"><a href="<?php echo $_SERVER['PHP_SELF'].'?language=en&country=us'; ?>" title="View in English">English</a> | <a href="<?php echo $_SERVER['PHP_SELF'].'?language=es&country=ar'; ?>" title="Ver en español">Spanish</a></div>
        <div id="reging"><?php include("reging.php"); ?></div>
        <div id="logo">
            <a href="index.php<?php if ($sid)
                                      echo "?sid=" . $sid; ?>"
                                  id="logo" title="NoHuyas.Com.Ar"><img src="<?php echo IMAGE_PATH . DS; ?>logo.png" alt="LaMantengo.Com.Ar" title="LaMantengo.Com.Ar" /></a><br /><h1>LaMantengo</h1></br></div>
        <?php
                              } else {
                                  include("404.php");
                              }
        ?>