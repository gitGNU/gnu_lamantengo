<?php

    /**
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
     * Link class is a template for Link objects.
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
    class Link {

        /**
         * Link ID
         *
         * @access private
         * @var String
         */
        private $_linkID;
        /**
         * Link Destination
         *
         * @access private
         * @var String
         */
        private $_link_destination;
        /**
         * Lamantengo Link
         *
         * @access private
         * @var String
         */
        private $_link_lamantengo;
        /**
         * Link description
         *
         * @access private
         * @var String
         */
        private $_link_description;
        /**
         * Last Modified
         *
         * @access private
         * @var String
         */
        private $_last_mod;
        /**
         * Link Owner ID
         *
         * @access private
         * @var String
         */
        private $_link_ownerID;
        /**
         * Active flag
         *
         * @access private
         * @var String
         */
        private $_active;
        /**
         * Number of visits
         *
         * @access private
         * @var String
         */
        private $_visits;

        /**
         * Link Object Constructor
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function __construct() {
            
        }

        /**
         * Link Object Destructor
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
         * Function gets object link ID
         *
         * @param
         * @access public
         *
         * @return String Link ID
         *
         */
        public function get_link_id() {
            return $this->_linkID;

        }

        /**
         * Function gets link destination
         *
         * @param
         * @access public
         *
         * @return String Link Destination
         *
         */
        public function get_link_destination() {
            return $this->_link_destination;

        }

        /**
         * Function gets lamantengo link
         *
         * @param
         * @access public
         *
         * @return String Lamantengo link
         *
         */
        public function get_lamantengo_link() {
            return $this->_link_lamantengo;

        }

        /**
         * Function gets link description
         *
         * @param
         * @access public
         *
         * @return String Link description
         *
         */
        public function get_link_description() {
            return $this->_link_description;

        }

        /**
         * Function gets last modified date
         *
         * @param
         * @access public
         *
         * @return String Last modified date
         *
         */
        public function get_last_mod() {
            return $this->_last_mod;

        }

        /**
         * Function gets link owner ID
         *
         * @param
         * @access public
         *
         * @return String Link Owner ID
         *
         */
        public function get_link_ownerID() {
            return $this->_link_ownerID;

        }

        /**
         * Function gets link status
         *
         * @param
         * @access public
         *
         * @return String Link status
         *
         */
        public function get_active_status() {
            return $this->_active;

        }

        /**
         * Function gets number of visits
         *
         * @param
         * @access public
         *
         * @return String Number of visits
         *
         */
        public function get_visits() {
            return $this->_visits;

        }

        /**
         * Function adds new link to database
         *
         * @param
         * @access public
         *
         * @return Boolean TRUE if successful, FALSE otherwise
         *
         */
        public static function add_new_link($dest, $desc) {
            global $database;
            global $user;

            $query = "INSERT INTO `links` (`uid`, `destination`, `description`)
                                   VALUES ( '$user->getUserID()',
                                            '$dest',
                                            '$desc')";
            //echo $query;
            // run query
            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function edits link attributes
         *
         * @param
         * @access public
         *
         * @return Boolean TRUE if successful, FALSE otherwise
         *
         */
        public function edit_link() {

        }

        /**
         * Function removes link from database
         *
         * @param
         * @access public
         *
         * @return Boolean TRUE if successful, FALSE otherwise
         *
         */
        public function remove_link() {

        }

    }

?>
