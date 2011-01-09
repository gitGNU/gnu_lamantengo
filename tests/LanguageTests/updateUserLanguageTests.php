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
        global $language;
        global $database;
        global $user;

        $test = new Test();

        $language->setLanguage('es');

        $result = $language->updateUserLanguage();

        $query = "SELECT language
                  FROM users
                  WHERE uid = '" . $user->getUserID() . "'";

        $result = $database->query($query);
        $data = $database->fetchArray($result);
        

        $test->failUnless("TEST - Update User Language",
                $data['language'] == 'es',
                "Error: Language Not Updated");

        //$language->setLanguage('en');
    }

?>
