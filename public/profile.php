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
define('INSITE', 1);
$title = "Perfil";
require_once("../includes/initialise.php");
include('get_sid.php');
$errores = ""; //vacio errores
$muestro_formulario = 1;
if ($uid) { //loggeado
    if ($_POST) { //Proceso datos del formulario
        $realname = $_POST['realname'];
        $new_pass = $_POST['new_pass'];
        $_POST['new_pass'] = "";
        $new_pass2 = $_POST['new_pass2'];
        $_POST['new_pass2'] = "";
        $password = md5($_POST['password']);
        $_POST['password'] = "";
        //busco errores y los meto como lista en $errores
        if ($new_pass != "") {
            if ($new_pass2 == "")
                $errores.="La confirmaci&oacute;n de nueva contrase&ntilde;a est&aacute; vac&iacute;a<br />\n";
            else
            if ($new_pass != $new_pass2)
                $errores.="Las nuevas contrase&ntilde;as no coinciden<br />\n";
            else {
                $new_pass2 = "";
                if (strlen($new_pass) < 6)
                    $errores.="La nueva contrase&ntilde;a debe tener al menos 6 caracteres<br />\n";
                else
                if (!(preg_match('/^[a-zA-Z0-9\.\(\)\-\_\!\@\=]{6,20}/', $new_pass))) {
                    $errores.="La nueva contrase&ntilde;a debe tener entre 6 y 20 caracteres que sean alfanum&eacute;ricos o los s&iacute;mbolos <b>.</b> ";
                    $errores.="<b>(</b> <b>)</b> <b>-</b> <b>_</b> <b>!</b> <b>@</b> <b>=</b><br />\n";
                } else { //no hay errores de password
                    $new_pass = md5($new_pass);
                }
            }
        }
        if (!$errores) {
            $query = "SELECT `active` FROM `users` WHERE `uid`='$uid' AND `password`='$password';";
            $rs = mysql_query($query);
            if (!($fila = mysql_fetch_object($rs)))
                $errores.="La contrase&ntilde;a ingresada es incorrecta<br />\n";
            else {
                if (!($fila->active))
                    $errores.="El usuario fue desactivado por la administraci&oacute;n<br />\n";
            }
            if (!$errores) {
                //actualizo los datos
                $query = "UPDATE `users` SET ";
                if ($new_pass)
                    $query.="`password`='$new_pass', ";
                $query.="`realname`='$realname' WHERE `uid`='$uid';";
                $rs = mysql_query($query);
                $success = "Los datos de la cuenta fueron actualizados exitosamente";
            }
        }
    } //FIN POST
}else { //Usuario no loggeado, lo echo
    $errores.="Debe <a href=\"login.php?sid=$sid\">iniciar sesi&oacute;n</a> para ver su perfil<br />\n";
    $muestro_formulario = 0;
}
//Muestro la pagina, con errores o success segun corresponda
include('header.php');
?>
<div id="contenido">
    <?
    if ($success) {
    ?>
        <div id="success"><?php echo $success; ?></div>
    <?php
    }
    if ($errores) {
    ?>
        <div id="errores"><?php echo $errores; ?></div>
    <?php
    }
    if ($muestro_formulario) {
    ?>
        <div id="form_reg">
            <form action="?sid=<?php echo $sid; ?>" method="POST">
                <table id="table_reg">
                    <tr id="tr_reg">
                        <td id="td_reg1">User:</td>
                        <td id="td_reg"><b><?php echo $username; ?></b></td>
                        <td id="td_reg2">&nbsp;</td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1">Email:</td>
                        <td id="td_reg"><?php echo $email; ?></td>
                        <td id="td_reg2">&nbsp;</td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1">Nombre:</td>
                        <td id="td_reg"><input id="text_reg" type="text" name="realname" value="<?php echo $realname; ?>" /></td>
                        <td id="td_reg2">Para usar en caso de contacto</td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1">Nuevo Password:</td>
                        <td id="td_reg"><input id="pass_reg" type="password" name="new_pass" value="" /></td>
                        <td id="td_reg2">6-20 caracteres alfanumericos </td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1">Repite nuevo password:</td>
                        <td id="td_reg"><input id="pass_reg" type="password" name="new_pass2" value="" /></td>
                        <td id="td_reg2">o los s&iacute;mbolos <b>. ( ) - _ ! @ =</b></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            &nbsp;
                        </td>
                    </tr>
                    <tr id="tr_reg">
                        <td id="td_reg1">Contrase&ntilde;a actual*:</td>
                        <td id="td_reg"><input id="pass_reg" type="password" name="password" value="" /></td>
                        <td id="td_reg2">Confirma los cambios</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" id="submit_reg" value="Modificar perfil" />
                            <input type="reset" id="reset_reg" value="Resetear" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    <?php } ?>
</div>
<div id="explanation">
			Ingrese el nombre de usuario con el que quiere registrarse en el sitio, su nombre real (opcional, solamente figurar&aacute; cuando debamos contactarnos con usted), y un e-mail v&aacute;lido.<br />
			Adem&aacute;s, ingrese las dos palabras que ve en la imagen, para verificar que usted es un humano, y no una computadora haciendo registros autom&aacute;ticos.<br />
			Se enviar&aacute; un mensaje a esa direcci&oacute;n indicando sus datos de inicio de sesi&oacute;n, y ser&aacute; la direcci&oacute;n de contacto asociada a su cuenta.<br />
			Para registrarse en el sitio tiene que estar de acuerdo con nuestros <a href="tos.php?sid=<?php echo $sid; ?>" target="_blank" title="Leer los ToS (en una ventana nueva)">T&eacute;rminos del Servicio</a>.
</div>
<?php
    include("footer.php");
?>