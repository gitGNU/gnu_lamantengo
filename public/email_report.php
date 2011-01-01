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
    $mail_to = $mail_nombre . ' <' . $mail_enviar_a . '>';
    $mail_subj = $language->translate("report_link");

    if ($mail_es_usuario)
        $mail_cuerpo = $language->translate("mail_username") . $username;
    else
        $mail_cuerpo = $language->translate("visitors") . $realname;
    $mail_cuerpo .= $language->translate("link_reported") . " <a href=\"http://www.lamantengo.com.ar/view.php?id=$id_link\">http://www.lamantengo.com.ar/view.php?id=$id_link</a>";
    if ($mail_destination)
        $mail_cuerpo .= $language->translate("suggesting") . " <b>$mail_destination</b> " . $language->translate("new_destination");
    $mail_cuerpo .= ".<br />\r\n";
    $mail_cuerpo .= $language->translate("his_message");
    $mail_cuerpo .= "<br />\r\n";
    $mail_cuerpo .= "<i>&quot;" . $mail_dice . "&quot;</i>";
    $mail_cuerpo .= "<br />\r\n";
    $mail_cuerpo .= $language->translate("you_can_contact") . $mail_nombre . $language->translate("at") . $mail_enviar_a . "<br />\r\n";

    include('enviar_email.php');

?>