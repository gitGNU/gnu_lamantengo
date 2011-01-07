<?php
/**
     * sessionTests.php
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

    // test to ensure that session is created when
    // user enters site
    function isSessionCreatedTest() {
        global $session;
        
        $test = new Test();

        $session_id = $session->getSessionId();

        $test->failUnless("TEST - Is Session Created",
                $session_id != "",
                "Error: Session ID is not set.");

    }

    // test to ensure session is added to database
    function isSessionAddedToDatabaseTest() {
        global $session;
        global $database;

        $test = new Test();

        $query = "SELECT sid FROM sessions
                  WHERE sid = '".$session->getSessionId() ."'";
        //echo "SESSION ID: ".$session->getSessionId();
        $result = $database->query($query);

        $test->failUnless("TEST - Is Session Added to Database",
                $database->numRows($result) == 1,
                "Error: Session not added to database.");
    }

    // test to ensure session is updated with
    // user ID when user logs in
    function isSessionUpdatedOnLoginTest() {

    }
    

?>
