<?php

    /**
     * loginUserTests.php
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

    function loginUserTest() {
        global $testNames;
        global $testResults;
        global $username;
        global $pass;
        global $database;
        global $user;

        $testNames[] = "TEST - Login User";

        $userIDQuery = "SELECT uid
                        FROM users
                        WHERE username = '$username'
                        AND password = '$pass'";

        $result = $database->query($userIDQuery);
        $data = $database->fetchArray($result);

        $user_id = $data['uid'];
        echo "USER ID: " . $user_id;
        // run test
        $user->loginUser($user_id);

        if (($_SESSION['username'] == "$username") && ($user->getUserID() == $user_id)) {
            $testResults[] = "PASSED";
        }
        else {
            $testResults[] = "FAILED";
        }

    }

?>
