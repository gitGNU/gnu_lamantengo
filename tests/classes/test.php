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
        public static $errMessage = array();
        public static $testErrors = array();
        private static $totalTests;
        private static $totalSuccess;
        private static $totalFailure;

        public function __construct() {
            Test::$totalTests = 0;
            Test::$totalSuccess = 0;
            Test::$totalFailure = 0;

            if (!empty(self::$errMessage)) {
                self::$testErrors[] = "Test Error";
            }

        }

        public function __destruct() {

        }

        public function failIf($testName, $condition, $error = "") {

            self::$testName[] = $testName;

            if ($condition == FALSE) {
                self::$testResult[] = "FAILED";
            }
            else {
                self::$testResult[] = "PASSED";
            }

            if ((self::$errMessage != "") && ($condition == FALSE)) {
                self::$errMessage[] = $error;
            }
            else {
                self::$errMessage[] = "";
            }

        }

        public function failUnless($testName, $condition, $error = "") {

            self::$testName[] = $testName;

            if ($condition == TRUE) {
                self::$testResult[] = "PASSED";
            }
            else {
                self::$testResult[] = "FAILED";
            }

            if ((self::$errMessage != "") && ($condition == FALSE)) {
                self::$errMessage[] = $error;
            }
            else {
                self::$errMessage[] = "";
            }

        }

        public function assertTrue($value, $error = "") {
            if ($value == TRUE) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        public function assertFalse($value, $error = "") {
            if ($value == FALSE) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        public function assertEquals($value1, $value2, $error = "") {
            if ($value1 == $value2) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        public static function printResults() {
            $i = 0; // local counter variable
//            echo "Number of error messages: ". count(Test::$errors)."<br />";
//
//            foreach(Test::$errors as $err) {
//                echo "Error ".$i.": '".$err."'<br />";
//                $i++;
//            }
//            $i = 0;

            echo '<table style="width:1100px; border:1px; margin-left:150px; font-size:14px;">
                  <tr>
                  <td colspan="2"><b><center>*****  Test Data Successfully Retrieved  *****</center></b></td>
                  </tr>

                    <tr>
                  <td colspan="2"><b><center>*****  Running Tests  *****</center></b></td>
                  </tr><hr />';

            foreach (self::$testName as $test) {

                if ((self::$errMessage[$i] != "") && (self::$errMessage != NULL)) {
                    echo '<tr>
                    <td style="width:900px;color:red;">' . $test . ' - ' . self::$errors[$i] . '</td>';
                }
                else {
                    echo '<tr>
                    <td style="width:900px;">' . $test . '</td>';
                }


                if (Test::$testResult[Test::$totalTests] == "PASSED") {
                    $r = 'style="color:green; weight:bold; font-size:14px;"';
                    self::$totalSuccess++;
                }
                else {
                    $r = 'style="color:red; weight:bold; font-size:14px;"';
                    self::$totalFailure++;
                }

                echo '<td ' . $r . '>' . self::$testResult[self::$totalTests] . '</td>';
                echo '</tr>';
                self::$totalTests++;
                $i++;
            }

            echo '<tr>
                <td colspan="2"><b><center>*****  Tests Completed  *****</center></b></td>
              </tr>
              <tr>
                <td><b>Number of Tests Run:</td>
                <td>' . self::$totalTests . '</td>
              </tr>
                <td><b>Success:</b></td>
                <td>' . self::$totalSuccess . '</td>
              </tr>
              <tr>
                <td><b>Failed:</b></td>
                <td>' . self::$totalFailure . '</td>
              </tr>
           </table>';

        }

    }

?>
