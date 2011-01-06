<!--
/**
 * run_tests.php
 * 
 * Copyright (C) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
 */ -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ar" xml:lang="es-ar">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Language" content="es-ar" />
        <meta name="description" content="Generador de links con destino modificable" />
        <link href="../includes/styles/styles.css" rel="stylesheet" type="text/css" />
        <link href="../includes/styles/page.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

        <title>UnitCheck</title>
        <link href="" rel="Top">
    </head>
    <body>
        <div id="header">
            <h1>UnitCheck</h1>
        </div> <!-- END header -->

        <div id="unitcheck-body">

            <?php

                // global test variables
                $testNames = array();
                $testResults = array();
                $username = "";
                $name = "";
                $newName = "";
                $email = "";
                $pass = "";
                $newPass = "";
                $newLinkDestination = "";
                $newLinkDescription = "";

                if (!empty($testNames)) {
                    echo "testNames not empty";
                }
                if (!empty($testResults)) {
                    echo "testResults not empty";
                }

                // included all relevant files
                // tested project files
                require_once("../includes/initialise.php");

                // test classes
                //require_once("classes/test.php");
                // tests init file
                require_once("initTests.php");
                require_once("finaliseTests.php");

                // tests functions
                require_once("UserTests/functionsExistTest.php");

                require_once("UserTests/registrationTests.php");
                require_once("UserTests/loginUserTests.php");
                require_once("UserTests/updateUserTests.php");
                require_once("UserTests/logoutUserTests.php");
                require_once("UserTests/languageSetTests.php");

                require_once("LanguageTests/updateUserLanguageTests.php");
                
                require_once("LinkTests/addNewLinkTest.php");

                // GET TEST DATA
                $registerDataResult = getUserTestData();
                $newLinkDataResult = getNewLinkTestData();

                // ensure required data is successfully set
                if (($registerDataResult == TRUE) && ($newLinkDataResult == TRUE)) {
                    echo '<table style="width:1100px; border:1px; margin-left:150px; font-size:14px;">
                  <tr>
                  <td colspan="2"><b><center>*****  Test Data Successfully Retrieved  *****</center></b></td>
                  </tr>';

                    // INIT TESTS //

                    cleanDatabase();


                    echo '<tr>
                  <td colspan="2"><b><center>*****  Running Tests  *****</center></b></td>
                  </tr><hr />';

                    // RUN TESTS //
                    // registration tests
                    registerNewUserTest();
                    // login test
                    loginUserTest();

                    // update user details test
                    updateUserProfileTest();
                    updateUserPasswordTest();
                    updateUserRealNameTest();
                    isLanguageSet();
                    
                    updateUserLanguageTest();

                    addNewLinkTest();
                    
                    // logout test
                    logoutUserTest();

                    // run method exists tests
                    //methodsExist();
                    // User class tests
                    // last thing to do is clean
                    // test data from database
                    cleanDatabase();

                    // to initialise new test object
                    //$test = new Test();


                    /**
                     *                  DISPLAY RESULTS
                     * =========================================================
                     */
                    $totalTests = 0; // $testResults counter
                    $totalSuccess = 0; // total succeeded
                    $totalFailure = 0; // total failed

                    echo '<h3>Test Data</h3>';
                    echo '<br />Username: '.$username;
                    echo '<br />Real Name: '.$name;
                    echo '<br />New Real Name: '.$newName;
                    echo '<br />Email: '.$email;
                    echo '<br />Password: '.$pass;
                    echo '<br />New Password: '.$newPass;
                    echo '<br />New Link Destination: '.$newLinkDestination;
                    echo '<br />New Link Description: '.$newLinkDescription;
                    echo '<br /><br />';
                    
                    foreach ($testNames as $test) {
                        echo '<tr>
                    <td style="width:900px;">' . $test . '</td>';

                        if ($testResults[$totalTests] == "PASSED") {
                            $r = 'style="color:green; weight:bold; font-size:14px;"';
                            $totalSuccess++;
                        }
                        else {
                            $r = 'style="color:red; weight:bold; font-size:14px;"';
                            $totalFailure++;
                        }

                        echo '<td ' . $r . '>' . $testResults[$totalTests] . '</td>';
                        echo '</tr>';
                        $totalTests++;
                    }

                    echo '<tr>
                <td colspan="2"><b><center>*****  Tests Completed  *****</center></b></td>
              </tr>
              <tr>
                <td><b>Number of Tests Run:</td>
                <td>' . $totalTests . '</td>
              </tr>
                <td><b>Success:</b></td>
                <td>' . $totalSuccess . '</td>
              </tr>
              <tr>
                <td><b>Failed:</b></td>
                <td>' . $totalFailure . '</td>
              </tr>
           </table>';
                }

            ?>

        </div>
        <div id="footer" style="text-align:center;">
            <hr />
            <p>Copyright &copy; 2010, 2011 Tom Kaczocha</p>
            <p>Please Report Bugs to <a href="mailto:freedomdeveloper@yahoo.com?subject=UnitCheck Project Bug" title="Bug Reporting">Project Developer</a></p>
        </div> <!-- END footer -->
    </body>
</html>