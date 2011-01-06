<?php

    /**
     * updateUserLanguageTests.php
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

    // this test tests for proper functionality of
    // updateUserLanguage() function in Language class
    // if affectedRows function returns 1, the function
    // is operating correctly as it should, else it fails
    function updateUserLanguageTest() {
        global $testNames;
        global $testResults;
        global $language;
        global $database;

        $testNames[] = "TEST - Update User Language";

        $result = $language->updateUserLanguage();

        if ($database->affectedRows($result) == 1) {
            $testResults[] = "PASSED";
        }
        else {
            $testResults[] = "FAILED";
        }

    }

?>
