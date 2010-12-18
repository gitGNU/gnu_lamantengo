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

define('INSITE', 1);
if (defined('INSITE')) {
    $mail_mensaje = "***********************************************************************<br />\r\n";
    $mail_mensaje.="*                                                                     *<br />\r\n";
    $mail_mensaje.= $language->translate("mail_line6");
    $mail_mensaje.= $language->translate("mail_line7");
    $mail_mensaje.= $language->translate("mail_line8");
    $mail_mensaje.= $language->translate("mail_line9");
    $mail_mensaje.="*                                                                     *<br />\r\n";
    $mail_mensaje.="***********************************************************************<br />\r\n";
    $mail_mensaje.="<br />\r\n";
    $mail_mensaje.= $language->translate("mail_line10") . " <b>$mail_nombre</b>:<br />\r\n";
    $mail_mensaje.="<br />\r\n";
    $mail_mensaje.="$mail_cuerpo<br />\r\n";
    $mail_mensaje.="<br />\r\n";
    $mail_mensaje.= $language->translate("mail_line11");
    $mail_mensaje.="***********************************************************************<br />\r\n";
    $mail_mensaje.="*                                                                     *<br />\r\n";
    $mail_mensaje.= $language->translate("mail_line12");
    $mail_mensaje.= $language->translate("mail_line13");
    $mail_mensaje.= $language->translate("mail_line14");
    $mail_mensaje.= $language->translate("mail_line15");
    $mail_mensaje.="*                                                                     *<br />\r\n";
    $mail_mensaje.="***********************************************************************";
    $mail_mensaje = wordwrap($mail_mensaje);
    $mail_head = "From: LaMantengo <no-reply@lamantengo.com.ar>\r\nReply-To: LaMantengo <no-reply@lamantengo.com.ar>";
    $mail_head.="MIME-Version: 1.0 \r\nContent-type: text/html; charset=UTF-8\r\n";
    $mail_head.="Bcc: nocaduca+forgot@gmail.com\r\n";
    if (@mail($mail_to, $mail_subj, $mail_cuerpo, $mail_head))
        $errores .= $language->translate("error_mail");
}else {
    include("404.php");
}
?>