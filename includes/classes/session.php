<?php

    /**
     * session.php
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
     */

    /**
     * Session class is a template for Session objects.
     *
     *
     * @package
     * @author	        Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	    2010 Tom Kaczocha
     * @license         GNU General Public License, version = 3.0
     * @version 	    1.0
     * @access	        public
     * 
     */
    class Session {

        /**
         * Session ID
         *
         * @access private
         * @var String
         */
        private $_sessionId;
        /**
         * Browser
         *
         * @access private
         * @var String
         */
        private $_browser;
        /**
         * IP address
         *
         * @access private
         * @var String
         */
        private $_ip;

        public function __construct() {

            session_start(); // start session
            $this->_sessionId = session_id();

        }

        public function __destruct() {
            // actions to perform when session ends            
        }

        /**
         * Function checks for an existing session
         * in the database
         *
         * @param
         * @access public
         *
         * @return Boolean TRUE if session exists, otherwise FALSE
         *
         */
        public function checkForSession() {
            global $database; // use global database object

            $session = session_id();

            $query = "SELECT `uid`,`lastmod`,`timeout`,`browser`,`ip` FROM `sessions`
        			  WHERE sid = '$session';";

            $result = $database->query($query);

            if ($database->numRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function adds a new session to database
         *
         * @param
         * @access public
         *
         * @return Boolean TRUE if session was successfully added to database
         * otherwise FALSE
         *
         *
         */
        public function setNewSession() {
            global $database;
            global $user;

            $this->_sessionId = session_id(); // assign session id
            $this->_browser = $_SERVER['HTTP_USER_AGENT']; // assign browser
            $this->_ip = $_SERVER['REMOTE_ADDR']; // assign ip address
            // build query
            $query = "INSERT INTO sessions (sid, uid, lastmod, timeout, browser, ip)
        			  VALUES ('$this->_sessionId',
        			  		  '$user->getUserId()',
        			  		  NOW(),
        			  		  '900',
        			  		  '$this->_browser',
        			  		  '$this->_ip');";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        public function getSessionId() {
            return $this->_sessionId;

        }

    }

    $session = new Session();

?>
