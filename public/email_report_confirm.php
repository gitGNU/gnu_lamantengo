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

    if (defined('INSITE')) {
        /*         * *************************************************
         * 	$mail_nombre = nombre de la persona
         * 	$mail_to = campo to ("Nombre <direccion>" o  "direccion")
         * 	$mail_subj = asunto del e-mail
         * 	$mail_cuerpo = cuerpo del mensaje
         * ************************************************** */
        $mail_nombre = $realname;
        $mail_to = $mail_nombre . ' <' . $email . '>';
        $mail_subj = $language->translate("check_report");

        $mail_cuerpo .= $language->translate("check_report_link");
        $mail_cuerpo .= "<a href=\"http://www.lamantengo.com.ar/report.php?action=confirm&id=$rid&key=$key\">http://www.lamantengo.com.ar/report.php?action=confirm&id=$rid&key=$key</a><br />\r\n";
        $mail_cuerpo .= "<br />\r\n";
        $mail_cuerpo .= $language->translate("mail_link_fails") . " http://www.lamantengo.com.ar/report.php?action=confirm&id=$rid&key=$key " . $language->translate("mail_browser");

        include('enviar_email.php');
    }
    else {
        include("404.php");
    }

?>