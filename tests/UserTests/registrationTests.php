<?php

    /**
     * registrationTests.php
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

    //echo "Including \"registrationTests.php\"<br />";
    // Register new user test
    function registerNewUserTest() {
        global $username;
        global $name;
        global $email;
        global $pass;
        global $user;

        $test = new Test();

        // run test
        $user->registerUser($username, $name, $email, $pass);


        global $database;

        $query = "SELECT * FROM users
                  WHERE username = '$username'
                  AND email = '$email'";

        $result = $database->query($query);

        $test->failUnless("TEST - Register New User",
                $database->numRows($result) == 1);

    }

?>
