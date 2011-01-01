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


    /*     * *************************************************
     * 	$mail_nombre = nombre de la persona
     * 	$mail_to = campo to ("Nombre <direccion>" o  "direccion")
     * 	$mail_subj = asunto del e-mail
     * 	$mail_cuerpo = cuerpo del mensaje
     * ************************************************** */
    if ($realname) {
        $mail_nombre = $realname;
    }
    else {
        $mail_nombre = $username;
    }
    $mail_to = $mail_nombre . ' <' . $email . '>';
    $mail_subj = $language->translate("mail_subject_lost_pass");

    $mail_cuerpo = $language->translate("mail_lost_pass_message");
    $mail_cuerpo .= "<br />\r\n";
    $mail_cuerpo .= $language->translate("mail_rebuild_login");
    $mail_cuerpo .= "<a href=\"http://www.lamantengo.com.ar/forgot.php?action=confirm&id=$uid&key=$key\">http://www.lamantengo.com.ar/forgot.php?action=confirm&id=$uid&key=$key</a><br />\r\n";
    $mail_cuerpo .= "<br />\r\n";
    $mail_cuerpo .= $language->translate("mail_link_fails") . " http://www.lamantengo.com.ar/forgot.php?action=confirm&id=$uid&key=$key" . $language->translate("mail_browser");
    $mail_cuerpo .= "<br />\r\n";
    $mail_cuerpo .= $language->translate("mail_receive_email");

    include('enviar_email.php');

?>