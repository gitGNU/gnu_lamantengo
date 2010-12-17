<?php

    /**
     * @License(name="GNU General Public License", version="3.0")
     *
     * Copyright (C) 2010 Tom Kaczocha <tom_kaczocha@yahoo.com.au>
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

    /**
     * My_Sql_Database class is a template for database connection objects.
     *
     * Copyright 	(c) 2010 Tom Kaczocha
     *
     * @package		
     * @author		Tom Kaczocha <tomk@resultsfocus.com.au>
     * @copyright	2010 Tom Kaczocha
     * @licence		
     * @version 	2.0
     * @access		public
     */
    class My_Sql_Database {

        /**
         * Magic Quotes Active Flag
         *
         * @access private
         * @var String
         */
        private $_mMagicQuotesActive;
        /**
         * Real Escape String Exists Flag
         *
         * @access private
         * @var String
         */
        private $_mRealEscapeStringExists;
        /**
         * Connection Flag
         *
         * @access private
         * @var String
         */
        private $_mConnection;
        /**
         * Last Query
         *
         * @access public
         * @var String
         */
        public $mLastquery;

        /**
         * Database Constructor
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function __construct() {
            $this->openConnection();
            $this->_mMagicQuotesActive = get_magic_quotes_gpc();
            $this->_mRealEscapeStringExists = function_exists("mysql_real_escape_string");
        }

        /**
         * Function opens a connection to the database
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function openConnection() {
            // Make the _mConnection.
            $this->_mConnection = mysql_connect(SERVER, DB_USER, DB_PASSWORD);

            if (!$this->_mConnection) {
                die('Could not connect to MYSQL: ' . mysql_error());
            }
            else {
                // Select the database
                $db_select = mysql_select_db(DB_NAME, $this->_mConnection);
                if (!$db_select) {
                    die('Could not select the database: ' . mysql_error());
                }
            }
        }

        /**
         * Function performs database query
         *
         * @param String $query Query
         * @access public
         *
         * @return String Result
         *
         */
        public function query($query) {
            $this->mLastquery = $query;
            $result = mysql_query($query, $this->_mConnection);
            $this->confirmQuery($result);
            return $result;
        }

        /**
         * Function closes last database connection
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function closeConnection() {
            if (isset($this->_mConnection)) {
                mysql_close($this->_mConnection);
                unset($this->_mConnection);
            }
        }

        /**
         * Function prepares query values for input
         *
         * @param String $value Query
         * @access public
         *
         * @return String Query
         *
         */
        public function escapeValue($value) {
            if ($_mRealEscapeStringExists) {

                if ($this->_mMagicQuotesActive) {
                    $value = stripslashes($value);
                }
                $value = mysql_real_escape_string($value);
            }
            else {
                // if magic quotes aren't already on then add slashes manually
                if (!$this->_mMagicQuotesActive) {
                    $value = addslashes($value);
                }
                // if magic quotes are active, then the slashes already exist
            }
            return $value;
        }

        /**
         * Function retrieves data from a query result
         *
         * @param String $result Result
         * @access public
         *
         * @return DataSet Dataset
         *
         */
        public function fetchArray($result) {
            return mysql_fetch_array($result);
        }

        /**
         * Function retrieves the number of rows from resultset
         *
         * @param String $result_set ResultSet
         * @access public
         *
         * @return String Number of Rows
         *
         */
        public function numRows($result_set) {
            return mysql_num_rows($result_set);
        }

        /**
         * Function gets the number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE query
         *
         * @param
         * @access public
         *
         * @return String Number of Rows
         *
         */
        public function affectedRows() {
            return mysql_affected_rows($this->_mConnection);
        }

        /**
         * Function confirms query
         *
         * @param $result ResultSet
         * @access private
         *
         * @return
         *
         */
        private function confirmQuery($result) {
            if (!$result) {
                $output = 'Database query failed: ' . mysql_error() . '<br /><br /';
                $output .= 'Last SQL query: ' . $this->mLastquery; // debugging message
                die($output);
            }
        }

    }

    $database = new My_Sql_Database();
?>