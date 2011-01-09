<?php

    /**
     *
     * Copyright (C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
     * UnitCheck class is a template for UnitCheck objects.
     *
     * Copyright 	(C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
     *
     * @package
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2011 Tom Kaczocha
     * @license         GNU General Public License, version 3.0
     * @version 	1.0
     * @access		public
     */
    class UnitCheck {

        private $_tests = array();


        public function __construct() {

        }

        public function __destruct() {
            
        }

        public function addTest(Test $test) {
            $this->_tests[] = $test;
            
        }

        public function removeTest(Test $test) {
            
        }

        public function printResults() {
            $i = 0; // local counter variable


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
                    <td style="width:900px;color:red;">' . $test . ' - ' . self::$errMessage[$i] . '</td>';
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
