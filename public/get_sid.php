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
        // I prefer the cookie and net the get, and if not empty
        if ($_COOKIE['sid'] != "") {
            $sid = $_COOKIE['sid'];
            $origen_sid = 'cookie';
        }
        elseif ($_GET['sid'] != "") {
            $sid = $_GET['sid'];
            $origen_sid = 'get';
        }
        else {
            $sid = "";
            $origen_sid = '';
        }
        // If no sid is 32 characters, I fruteo ... clean
        if (strlen($sid) != 32) {
            $sid = "";
            $origen_sid = '';
        }
        if ($sid) {
            // if sid, the look in the db and bring uid and times
            $query = "SELECT `uid`,`lastmod`,`timeout`,`browser`,`ip` FROM `sessions` WHERE `sid`='$sid';";
            // echo $query;
            $rs = mysql_query($query);
            $temp = mysql_fetch_object($rs);
            if ($temp != "") { // session there
                $uid = 0;
                if (($temp->browser != $_SERVER['HTTP_USER_AGENT']) || (($origen_sid != 'cookie') && ($temp->ip != $_SERVER['REMOTE_ADDR']))) {
                    // change the browser or the session cookie is not and change the ip. ergo, it regenerates the SID, but the session is still alive
                    $sid = '';
                }
                if (($temp->timeout) && (($temp->lastmod + $temp->timeout) < time())) {
                    // the session is timeout, and expired. reusing the sid (change the uid to 0 and change the lastmod, but I'm using the same SID for the user
                    $query = "UPDATE `sessions` SET `lastmod` = '" . time() . "', `uid`=0 WHERE `sessions`.`sid` = '$sid' LIMIT 1 ;";
                    $rs = mysql_query($query);
                }
                else {
                    // valid session. uid and update assigned lastmod
                    $uid = $temp->uid;
                    $query = "UPDATE `sessions` SET `lastmod` = '" . time() . "' WHERE `sid`='$sid'; ";
                    $rs = mysql_query($query);
                }
                setcookie("sid", "$sid");
            }
            else {
                // I could not find the sid
                $sid = "";
            }
        }
        if (!($sid)) {
            // sid or had not, or not found in the db. I create a new sid and keep
            list($usec, $sec) = explode(' ', microtime());
            $seed = (float) $sec + ((float) $usec * 100000);
            srand($seed);
            $sid = md5(uniqid(rand(), 1));
            $query = "INSERT INTO `sessions` (`sid`,`uid` ,`lastmod` ,`timeout`,`browser`,`ip`) VALUES ( '$sid', '0', '" . time() . "', '900','" . $_SERVER["HTTP_USER_AGENT"] . "','" . $_SERVER['REMOTE_ADDR'] . "');";
            //echo $query;
            $rs = mysql_query($query);
            setcookie("sid", "$sid");
            $uid = "";
        }
        //echo $query;
    }
    else {
        include("404.php");
    }

?>