<?php

/**
 * @License(name="GNU General Public License", version="3.0")
 * 
 * Copyright (C) 2010 UnWebmaster.Com.Ar
 * Copyright (C) 2010 Tom Kaczocha <freedomdevelop@yahoo.com>
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

if (defined('INSITE')) {
    /*     * *************************************************
     * 	$mail_nombre = nombre de la persona
     * 	$mail_to = campo to ("Nombre <direccion>" o  "direccion")
     * 	$mail_subj = asunto del e-mail
     * 	$mail_cuerpo = cuerpo del mensaje
     * ************************************************** */
    if ($realname) {
        $mail_nombre = $realname;
    } else {
        $mail_nombre = $username;
    }
    $mail_to = $mail_nombre . ' <' . $email . '>';
    $mail_subj = $language->translate("mail_subj");

    $mail_cuerpo  = $language->translate("mail_line1");
    $mail_cuerpo .= "<br />\r\n";
    $mail_cuerpo .= $language->translate("mail_line2");
    $mail_cuerpo .= "<br />\r\n";
    $mail_cuerpo .= $language->translate("mail_line3");
    $mail_cuerpo .= $language->translate("mail_username") . "<b>$username</b><br />\r\n";
    $mail_cuerpo .= $language->translate("mail_password") . "<b>$password</b><br />\r\n";
    $mail_cuerpo .= "<br />\r\n";
    $mail_cuerpo .= $language->translate("mail_line4");
    $mail_cuerpo .= "<br />\r\n";
    $mail_cuerpo .= $language->translate("mail_line5");

    include('enviar_email.php');
} else {
    include("404.php");
}
?>