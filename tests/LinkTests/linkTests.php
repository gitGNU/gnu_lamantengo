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

        global $newLinkDestination;
        global $newLinkDescription;
        global $user;

        $test = new Test();

        $link = new Link();

        $link->addNewLink($newLinkDestination, $newLinkDescription);

        $query = "SELECT * FROM links
                  WHERE destination = '" . $newLinkDestination . "'
                  AND description = '" . $newLinkDescription . "';";

        $result = $database->query($query);

        $test->failUnless("TEST - Add New Link",
                $database->numRows($result) == 1);

    }

    // test for adding User_ID to new link
    function addUserIDToLinkTest() {
        global $database;
        global $user;

        global $newLinkDestination;

        $test = new Test();

        $query = "SELECT * FROM links
                  WHERE destination = '" . $newLinkDestination . "'
                  AND uid = '" . $user->getUserID() . "'";

        $result = $database->query($query);

        $test->failUnless("TEST - User ID Added To New Link",
                $database->numRows($result) == 1,
                "Error: Link User ID does not match Link Owner");

    }

    // test checks for whether function returns link
    // dataset
    function getLinkDataSetByIDTest() {
        global $database;
        global $newLinkDestination;
        global $newLinkDescription;

        $test = new Test();

        $link = new Link();

        $query = "SELECT lid
                  FROM links
                  WHERE destination = '" . $newLinkDestination . "'";

        $result = $database->query($query);
        $data = $database->fetchArray($result);

        if (!empty($data)) {
        $lid = $data['lid'];

        $data = $link->getLinkDataSetByID($lid);

        $test->failUnless("TEST - Get Link DataSet",
                (($data['destination'] == $newLinkDestination) &&
                ($data['description'] == $newLinkDescription) &&
                ($data['lid'] == $lid)),
                "Error: Unable to get Link DataSet");
        }
        else {
            "'getLinkDataSetByIDTest()' Failed";
        }

    }

    // test the creation of
//    function newLamantengoLinkCreatedTest() {
//        global $database;
//
//        $test = new Test();
//
//
//        $test->failUnless("TEST - Lamantengo Link Created",
//                $data[''], $error)
//
//    }

?>
