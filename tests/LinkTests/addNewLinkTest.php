<?php

    /**
     * addnewLinkTest.php
     *
     * Copyright (C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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

    function addNewLinkTest() {
        global $database;
        global $testNames;
        global $testResults;
        
        global $newLinkDestination;
        global $newLinkDescription;
        global $user;

        $testNames[] = "TEST - Add New Link";
        
        $link = new Link();

        $link->add_new_link($newLinkDestination, $newLinkDescription);

        $query = "SELECT * FROM links
                  WHERE uid = '".$user->getUserID()."';";

        $result = $database->query($query);
        $data = $database->fetchArray($result);

        print_r($data);
        //if ($data[])
        

        
        $testResults[] = "FAILED";
        

    }

?>
