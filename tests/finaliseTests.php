<?php

    /**
     * finaliseTests.php
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

    // function cleans database of test data
    function cleanDatabase() {
        global $database;
        global $username;
        global $name;
        global $email;
        global $pass;
        global $updatedDestination;
        global $updatedDescription;


        $status = 0; // holds test status

        $userQuery = "DELETE FROM users
                      WHERE username = '$username'
                            AND email = '$email'
                      LIMIT 1";

        $linkQuery = "DELETE FROM links
                      WHERE destination = '$updatedDestination'
                      AND description = '$updatedDescription'
                      LIMIT 1";

        $result = $database->query($userQuery);

        if ($database->affectedRows($result) == 1) {
            $status++;
        }

        $result = $database->query($linkQuery);

        if ($database->affectedRows($result) == 1) {
            $status++;
        }

        return $status;

    }

?>
