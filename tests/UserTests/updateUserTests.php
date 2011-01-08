<?php

    /**
     * updateUserTests.php
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
    /*
     *
     * This test must be run after loginUserTests because it requires
     * the user to be logged in
     *
     */
    require_once("../includes/initialise.php");

    //echo "Including \"registrationTests.php\"<br />";
    // Register new user test
    function updateUserProfileTest() {
//        global $testNames;
//        global $testResults;
        global $username;
        global $name;
        global $newName;
        global $email;
        global $pass;
        global $newPass;
        global $user;

        $test = new Test();

//        $testNames[] = "TEST - Update User Profile";
        // run test
        $user->updateProfile($newName, $newPass);

        global $database;

        $query = "SELECT realname
                  FROM users
                  WHERE username = '$username'
                  AND email = '$email';";

        $result = $database->query($query);
        $data = $database->fetchArray($result);

        $test->failUnless("TEST - Update User Profile",
                $data['realname'] == $newName);

    }

    function updateUserPasswordTest() {
        global $username;
        global $name;
        global $newName;
        global $email;
        global $pass;
        global $newPass;
        global $user;

        $test = new Test();

        $user->updateUserPassword($newPass);

        global $database;

        $query = "SELECT password
                  FROM users
                  WHERE username = '$username'
                  AND email = '$email';";

        $result = $database->query($query);
        $data = $database->fetchArray($result);

        $test->failUnless("TEST - Update Password",
                $data['password'] == $newPass);

    }

    // function tests the updating of user
    function updateUserRealNameTest() {
        global $username;
        global $name;
        global $newName;
        global $email;
        global $pass;
        global $newPass;
        global $user;

        $test = new Test();

        $user->updateRealName($newName);

        global $database;

        $query = "SELECT realname
                  FROM users
                  WHERE username = '$username'
                  AND email = '$email';";

        $result = $database->query($query);
        $data = $database->fetchArray($result);

        $test->failUnless("TEST - Update Real Name",
                $data['realname'] == $newName);

    }

?>
