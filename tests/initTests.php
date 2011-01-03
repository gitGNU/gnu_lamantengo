<?php

    /**
     * Comment here
     *
     * Copyright 	(c) 2010 Tom Kaczocha
     *
     * This file is part of UnitCheck.
     *
     * UnitCheck is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     *
     * UnitCheck is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with UnitCheck.  If not, see <http://www.gnu.org/licenses/>.
     *
     *
     * @package
     * @author	Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2010 Tom Kaczocha
     * @version 	1.0
     * @access	public
     * @License     "GNU General Public License", version="3.0"
     *
     */
    /*
     *
     * These functions initialises the testing module
     *
     */

    require_once("../includes/initialise.php");

    // function reads register test data in from
    // registerData file
    function getUserTestData() {
        global $username;
        global $name;
        global $newName;
        global $email;
        global $pass;
        global $newPass;
        global $newLinkDestination;
        global $newLinkDescription;

        // open file for reading
        $filename = SITE_ROOT . DS . "tests" . DS . "testdata" . DS . "userData";
        //echo $filename . "<br />";
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');

            $username = fgets($file);
            $name = fgets($file);
            $newName = fgets($file);
            $email = fgets($file);
            $pass = fgets($file);
            $newPass = fgets($file);
            
            // close file
            fclose($file);

            return TRUE;
        }
        else {
            die("'registerData' file does not exist in specified path.<br />");
        }

    }

    // function reads new link test data in from
    // linkData file
    function getNewLinkTestData() {
        global $newLinkDestination;
        global $newLinkDescription;

        // open file for reading
        $filename = SITE_ROOT . DS . "tests" . DS . "testdata" . DS . "linkData";
        //echo $filename . "<br />";
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');

            $newLinkDestination = fgets($file);
            $newLinkDescription = fgets($file);

            // close file
            fclose($file);

            return TRUE;
        }
        else {
            die("'linkData' file does not exist in specified path.<br />");
        }
    }

?>
