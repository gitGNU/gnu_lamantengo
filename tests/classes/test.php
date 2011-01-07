<?php

    /**
     *
     * Copyright (C) 2010 Tom Kaczocha <freedomdeveloper@yahoo.com>
     *
     * This file is part of UnitCheck.
     *
     * UnitCheck is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     *
     * UnitCheck is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with UnitCheck.  If not, see <http://www.gnu.org/licenses/>.
     *
     */

    /**
     * Test class is a template for Test objects.
     *
     * Copyright 	(c) 2010 Tom Kaczocha
     *
     * @package
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2010 Tom Kaczocha
     * @license         GNU General Public License, version 3.0
     * @version 	2.0
     * @access		public
     */
    class Test {

        public static $testName = array();
        public static $testResult = array();
        public static $errors = array();
        private static $totalTests;
        private static $totalSuccess;
        private static $totalFailure;

        public function __construct() {
            Test::$totalTests = 0;
            Test::$totalSuccess = 0;
            Test::$totalFailure = 0;

        }

        public function __destruct() {

        }

        public function failIf($testName, $condition) {

            Test::$testName[] = $testName;

            if ($condition == FALSE) {
                Test::$testResult[] = "FAILED";
            }
            else {
                Test::$testResult[] = "PASSED";
            }

        }

        public function failUnless($testName, $condition, $error = "") {

            Test::$testName[] = $testName;

            if ($condition == TRUE) {
                Test::$testResult[] = "PASSED";
            }
            else {
                Test::$testResult[] = "FAILED";
            }

            if (Test::$errors != "") {
                Test::$errors[] = $error;
            }
            else {
                Test::$errors[] = "";
            }

        }

        public static function printResults() {
            $i = 0; // local counter variable

            echo '<table style="width:1100px; border:1px; margin-left:150px; font-size:14px;">
                  <tr>
                  <td colspan="2"><b><center>*****  Test Data Successfully Retrieved  *****</center></b></td>
                  </tr>

                    <tr>
                  <td colspan="2"><b><center>*****  Running Tests  *****</center></b></td>
                  </tr><hr />';

            foreach (Test::$testName as $test) {

                if (Test::$errors[$i] != "") {
                    echo '<tr>
                    <td style="width:900px;color:red;">' . $test . ' - ' . Test::$errors[$i] . '</td>';
                }
                else {
                    echo '<tr>
                    <td style="width:900px;">' . $test . '</td>';
                }


                if (Test::$testResult[Test::$totalTests] == "PASSED") {
                    $r = 'style="color:green; weight:bold; font-size:14px;"';
                    Test::$totalSuccess++;
                }
                else {
                    $r = 'style="color:red; weight:bold; font-size:14px;"';
                    Test::$totalFailure++;
                }

                echo '<td ' . $r . '>' . Test::$testResult[Test::$totalTests] . '</td>';
                echo '</tr>';
                Test::$totalTests++;
                $i++;
            }

            echo '<tr>
                <td colspan="2"><b><center>*****  Tests Completed  *****</center></b></td>
              </tr>
              <tr>
                <td><b>Number of Tests Run:</td>
                <td>' . Test::$totalTests . '</td>
              </tr>
                <td><b>Success:</b></td>
                <td>' . Test::$totalSuccess . '</td>
              </tr>
              <tr>
                <td><b>Failed:</b></td>
                <td>' . Test::$totalFailure . '</td>
              </tr>
           </table>';

        }

    }

    $test = new Test();

//class FunctionTest extends Test {
//
//}
//
//class ClassTest extends Test {
//
//}
//
//class ObjectTest extends Test {
//
//}

?>
