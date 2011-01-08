<?php

    /**
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
     * User class is a template for User objects.
     *
     * Copyright 	(c) 2010 Tom Kaczocha
     *
     * @package
     * @author	        Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2010 Tom Kaczocha
     * @license         GNU General Public License, version = 3.0
     * @version 	1.0
     * @access	        public
     */
    class User {

        /**
         * User ID
         *
         * @access private
         * @var String
         */
        private $_userID;
        /**
         * Username
         *
         * @access private
         * @var String
         */
        private $_username;
        /**
         * Password
         *
         * @access private
         * @var String
         */
        private $_password;
        /**
         * User First Name
         *
         * @access private
         * @var String
         */
        private $_realName;
        /**
         * User Email
         *
         * @access private
         * @var String
         */
        private $_email;
        /**
         * User Language
         *
         * @access private
         * @var String
         */
        private $_language;
        /**
         * Is Logged in Flag
         *
         * @access private
         * @var String
         */
        private $_userIsLoggedIn;
        /**
         * Is Active flag
         *
         * @access private
         * @var String
         */
        private $_isActive;

        /**
         * User Object Constructor
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function __construct($user_id = 0) {
            global $session;

            $this->checkUserLogin();
            $this->initUser($user_id);
            
            // check for matching session in database
            $session_status = $session->checkForSession();

            if ($session_status) {// match -> update session object
                $this->updateSession();
            }
            else { // no match -> create new session object
                $session->setNewSession();
            }

        }

        private function initUser($user_id) {
            $data = $this->getUserDatasetById($user_id);

            $this->_userID = $data['uid'];
            $this->_username = $data['username'];
            $this->_email = $data['email'];
            $this->_realName = $data['realname'];
            $this->_password = $data['password'];
            $this->_isActive = $data['active'];            
            $this->setUserLanguage($data['language']);

            if ($this->_userID == "") {
                $this->_userID = $user_id;
            }
        }

        /**
         * User Object Destructor
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function __destruct() {
            
        }

        /**
         * Function gets user ID
         *
         * @param
         * @access public
         *
         * @return String User ID
         *
         */
        public function getUserID() {
            return $this->_userID;

        }

        /**
         * Function gets Username
         *
         * @param
         * @access public
         *
         * @return String Username
         *
         */
        public function getUsername() {
            return $this->_username;

        }

        /**
         * Function gets users first name
         *
         * @param
         * @access public
         *
         * @return String User first name
         *
         */
        public function getUserRealName() {
            return $this->_realName;

        }

        /**
         * Function gets users email
         *
         * @param
         * @access public
         *
         * @return String User Email
         *
         */
        public function getUserEmail() {
            return $this->_email;

        }

        /**
         * Function gets users language preference
         *
         * @param
         * @access public
         *
         * @return String Language preference
         *
         */
        public function getUserLanguage() {
            return $this->_language;

        }

        /**
         * Function gets users status
         *
         * @param
         * @access public
         *
         * @return Boolean TRUE if active, FALSE otherwise
         *
         */
        public function getIsUserActive() {
            return $this->_isActive;

        }

        /**
         * Function sets User ID
         *
         * @param String $id User ID
         * @access private
         *
         * @return
         *
         */
        private function setUserID($id) {
            $this->_userID = $id;

        }

        /**
         * Function sets Username
         *
         * @param String $username Username
         * @access private
         *
         * @return
         *
         */
        private function setUsername($username) {
            $this->_username = $username;

        }

        /**
         * Function sets user password
         *
         * @param String $password Password
         * @access private
         *
         * @return
         *
         */
        private function setPassword($password) {
            $this->_password = $password;

        }

        /**
         * Function sets user first name
         *
         * @param String $firstname First Name
         * @access private
         *
         * @return
         *
         */
        private function setRealName($firstname) {
            $this->_realName = $firstname;

        }

        /**
         * Function sets user email
         *
         * @param String $email Email
         * @access private
         *
         * @return
         *
         */
        private function setUserEmail($email) {
            $this->_email = $email;

        }

        private function setIsActive($status) {
            $this->_isActive = $status;

        }

        public function setUserLanguage($language = '') {
            
            if ($language == "") { // if language not yet set
                if (isset($_SESSION['language'])) {
                    $this->_language = $_SESSION['language'];
                }
                else {
                    $this->_language = LAN;
                }
            }
            else { // language has already been set for user
                $this->_language = $language;
            }



        }

        /**
         * Function gets user dataset
         *
         * @param String $user_id User ID
         * @access private
         *
         * @return Dataset User dataset
         *
         */
        public function getUserDatasetById($user_id) {
            global $database;

            $query = "SELECT *
            		  FROM `users`
            		  WHERE `uid` = '$user_id'";

            $result = $database->query($query);
            $data = $database->fetchArray($result);
            return $data;

        }

        /**
         * Function checks whether user is logged in
         * Sets Flag to TRUE if logged in, FALSE if not
         *
         * @param
         * @access private
         *
         * @return
         *
         */
        private function checkUserLogin() {
            if (isset($_SESSION['user_id'])) {
                $this->_userID = $_SESSION['user_id'];
                $this->_userIsLoggedIn = true;
            }
            else {
                unset($this->_userID);
                $this->_userIsLoggedIn = false;
            }

        }

        /**
         * Function checks whether user is logged in
         *
         * @param
         * @access public
         *
         * @return Boolean TRUE if logged in, FALSE if not
         */
        public function isUserLoggedIn() {
            return $this->_userIsLoggedIn;

        }

        /**
         * Function authenticates user login attempt
         * 
         * @param String $username Username
         * @param String $password Password
         * 
         * @access public
         * @static
         * @return String|Boolean Username if login Successful, FALSE otherwise
         *
         */
        public static function authenticateUser($username = '', $password = '') {
            global $database;

            $query = "SELECT uid, username, active
			 FROM users
			 WHERE username = '$username'
			 AND password = md5('$password')
			 LIMIT 1";

            $result = $database->query($query);
            $data = $database->fetchArray($result);
            return!empty($data) ? $data[0] : false;

        }

        /**
         * Function logs user in
         * 
         * @param String $user_id
         * @access public
         * 
         * @return
         *
         */
        public function loginUser($user_id) {
            if ($user_id) {
                $this->_userID = $_SESSION['user_id'] = $user_id;
                $this->_userIsLoggedIn = TRUE;
                $this->initUser($this->_userID);
                $_SESSION['username'] = $this->_username;
            }

        }

        /**
         * Function logs user out
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function logoutUser() {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($this->_UserID);
            $this->_userIsLoggedIn = false;

        }

        /**
         * Function registers user in database
         *
         * @param String $username Username
         * @param String $realname Real Name
         * @param String $email Email
         * @param String $pass_hash md5 Password
         * @access public
         *
         * @return Boolean TRUE if Successful, FALSE otherwise
         *
         */
        public function registerUser($username, $realname, $email, $pass_hash) {
            global $database;
            $clean_username = strtolower($username);

            $query = "INSERT INTO `users` (`username`,`username_clean` ,
                                            `realname` ,`email` ,`password`,
                                            `active`)
                                   VALUES ( '$username',
                                            '$clean_username',
                                            '$realname',
                                            '$email',
                                            '$pass_hash',
                                            '1');";

            $result = $database->query($query);

            if ($result == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function generates a new password
         *
         * @param
         * @access public
         *
         * @return String Password
         *
         */
        public function generatePassword() {
            $pass = "";
            $c = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ)(-_!@=.0123456789";
            /*             * for($i=0;$i<26;$i++)
              $c[$i]=chr(97+$i);
              for($i=0;$i<26;$i++)
              $c[$i+26]=chr(65+$i);
              $c[52]=")";
              $c[53]="(";
              $c[54]="-";
              $c[55]="_";
              $c[56]="!";
              $c[57]="@";
              $c[58]="=";
              $c[59]=".";
              for($i=0;$i<10;$i++)
              $c[$i+60]=$i;* */
            $pass = "";
            for ($i = 0; $i < 12; $i++)
                $pass.=$c[rand(0, 69)];
            return $pass;

        }

        /**
         * Function is a wrapper for filer_var and
         * validates entered email
         *
         * @param String $address
         * @access public
         *
         * @return Boolean TRUE if successful, otherwise FALSE
         *
         */
        public function validate_email($address) {
            if (function_exists('filter_var')) {
                if (filter_var($address, FILTER_VALIDATE_EMAIL) === FALSE) {
                    return false;
                }
                else {
                    return true;
                }
            }
            else {
                return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $address);
            }

        }

        /**
         * Function is a wrapper for filer_var and
         * validates entered email
         *
         * @param String $address
         * @access public
         *
         * @return Boolean TRUE if successful, otherwise FALSE
         *
         */
        public function updateProfile($realname, $new_pass) {
            global $database;

            $query = "UPDATE users
                      SET password = '$new_pass',
			  realname = '$realname'
		      WHERE uid = '" . $this->_userID . "'";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function updates user password
         *
         * @param String $new_pass New Password
         * @access public
         *
         * @return Boolean TRUE if Successful, FALSE otherwise
         *
         */
        public function updateUserPassword($new_pass) {
            global $database;

            $query = "UPDATE users
                      SET password = '$new_pass'
		      WHERE uid = '$this->_userID'";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function updates users realname
         *
         * @param String $realname Real Name
         * @access public
         *
         * @return Boolean TRUE if Successful, FALSE otherwise
         *
         */
        public function verifyPassword($password) {

            if ($password == $this->_password) {
                //if ($database->numRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function verifies entered password
         *
         * @param String $password Password
         * @access public
         *
         * @return Boolean TRUE if Successful, FALSE otherwise
         *
         */
        public function updateRealName($realname) {
            global $database;

            $query = "UPDATE users
                      SET realname = '$realname'
		      WHERE uid = '$this->_userID'";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function updates user ID in session table
         *
         * @param
         * @access public
         *
         * @return Boolean TRUE if session exists, otherwise FALSE
         *
         */
        public function updateSession() {
            global $database;
            global $session;

            $query = "UPDATE sessions
                      SET uid = '" . $this->_userID . "' 
                      WHERE sid = '" . $session->getSessionID() . "'";

            //echo "Update Session Query: " . $query;
            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }
        
    }

    // When user first enters the site they are given a user_id
    // of 0... if they register, or login they get their real
    // user ID
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    else {
        $user_id = 0;
    }

    $user = new User($user_id);

?>
