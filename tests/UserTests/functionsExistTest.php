<?php

    /**
     * functionsExistTest.php
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

    // function tests for the existence of
    // methods in a class
    function methodsExist() {
        global $testNames;
        global $testResults;
        
        $user = new User();

        if (method_exists($user, "getUsername")) {
            $testNames[] = "Function 'getUsername()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'getUsername()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "getUserRealName")) {
            $testNames[] = "Function 'getUserRealName()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'getUserRealName()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "initUser")) {
            $testNames[] = "Function 'initUser()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'initUser()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "getUserID")) {
            $testNames[] = "Function 'getUserID()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'getUserID()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "getUserEmail")) {
            $testNames[] = "Function 'getUserEmail()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'getUserEmail()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "getUserLanguage")) {
            $testNames[] = "Function 'getUserLanguage()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'getUserLanguage()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "getIsUserActive")) {
            $testNames[] = "Function 'getIsUserActive()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'getIsUserActive()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "setUserID")) {
            $testNames[] = "Function 'setUserID()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'setUserID()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "setUsername")) {
            $testNames[] = "Function 'setUsername()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'setUsername()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "setPassword")) {
            $testNames[] = "Function 'setPassword()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'setPassword()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "setRealName")) {
            $testNames[] = "Function 'setRealName()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'setRealName()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "setUserEmail")) {
            $testNames[] = "Function 'setUserEmail()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'setUserEmail()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "setIsActive")) {
            $testNames[] = "Function 'setIsActive()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'setIsActive()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "getUserDatasetById")) {
            $testNames[] = "Function 'getUserDatasetById()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'getUserDatasetById()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "checkUserLogin")) {
            $testNames[] = "Function 'checkUserLogin()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'checkUserLogin()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "isUserLoggedIn")) {
            $testNames[] = "Function 'isUserLoggedIn()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'isUserLoggedIn()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "authenticateUser")) {
            $testNames[] = "Function 'authenticateUser()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'authenticateUser()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "loginUser")) {
            $testNames[] = "Function 'loginUser()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'loginUser()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "logoutUser")) {
            $testNames[] = "Function 'logoutUser()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'logoutUser()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "registerUser")) {
            $testNames[] = "Function 'registerUser()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'registerUser()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "generatePassword")) {
            $testNames[] = "Function 'generatePassword()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'generatePassword()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "validate_email")) {
            $testNames[] = "Function 'validate_email()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'validate_email()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "updateProfile")) {
            $testNames[] = "Function 'updateProfile()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'updateProfile()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "updateUserPassword")) {
            $testNames[] = "Function 'updateUserPassword()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'updateUserPassword()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "verifyPassword")) {
            $testNames[] = "Function 'verifyPassword()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'verifyPassword()' exists";
            $testResults[] = "FAILED";
        }

        if (method_exists($user, "updateRealName")) {
            $testNames[] = "Function 'updateRealName()' exists";
            $testResults[] = "PASSED";
        }
        else {
            $testNames[] = "Function 'updateRealName()' exists";
            $testResults[] = "FAILED";
        }
    }
    
?>
