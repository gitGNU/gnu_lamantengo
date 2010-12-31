<?php

    /**
     * Copyright (C) 2010 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
        private $_first_name;
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
            //print_r($_SESSION);
            //echo "USER ID: ".$user_id;
            $this->checkUserLogin();
            $this->initUser($user_id);

        }

        private function initUser($user_id) {
            $data = $this->getUserDatasetById($user_id);

            $this->setUserID($data['uid']);
            $this->setUsername($data['username']);
            $this->setUserEmail($data['email']);
            $this->setFirstName($data['realname']);
            $this->setPassword($data['password']);
            $this->setIsActive($data['active']);

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
        public function getUserFirstName() {
            return $this->_first_name;

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
        private function setFirstName($firstname) {
            $this->_first_name = $firstname;

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
                //echo "User Initialised<br />";
                //echo "USER ID in SESSION: ".$_SESSION['user_id']."<br />";
                //echo "USER STATUS: ".$this->_userIsLoggedIn."<br />";
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

    }

    // When user first enters the site they are given a user_id
    // of 0... if they register, or login they get their real
    // user ID
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }

    $user = new User($user_id);

?>
