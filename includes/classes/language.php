<?php

    /**
     * @License(name="GNU General Public License", version="3.0")
     *
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
     * Language class is a template for Language objects.
     *
     * Copyright 	(c) 2010 Tom Kaczocha
     *
     * @package     
     * @author	    Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2010 Tom Kaczocha
     * @license     GNU General Public License, version = 3.0
     * @version 	1.0
     * @access	    public
     */
    class Language {

        /**
         * language
         *
         * @access private
         * @var String
         */
        private $_language;
        /**
         * country
         *
         * @access private
         * @var String
         */
        private $_country;
        /**
         * Message array
         *
         * @access private
         * @var String
         */
        private $_message_arr;

        /**
         * Language object constructor
         *
         * @param String $language Language to instantiate the object with
         * @param String $country Country to instantiate the object with
         * @access public
         *
         * @return
         *
         */
        public function __construct($language = "en", $country="us") {
            $this->setLocale($language, $country);
            $this->_message_arr = array(); // create array
            $this->fillArray();

        }

        /**
         * Language object destructor
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
         * Function sets the locale for the language object.
         *
         * @param String $language Language for the object
         * @param String $country Country for the object
         * @access public
         *
         * @return
         *
         */
        public function setLocale($language = '', $country = '') {

            if ($language == '' || $country == '') {
                $this->_language = $_SESSION['language'];
                $this->_country = $_SESSION['country'];
            }
            else {
                $this->_language = $language;
                $this->_country = $country;
            }

        }

        /**
         * Function translates message depending on langauge and country
         *
         * @param String $message Message to translate
         * @access public
         *
         * @return
         *
         */
        public function translate($message) {
            return $this->_message_arr[$this->_language][$message];

        }

        /**
         * Function fills array with message strings from file
         *
         * @param
         * @access private
         *
         * @return
         *
         */
        private function fillArray() {
            $username = $_SESSION['username'];
            include("../includes/locale/en_us.inc");
            include("../includes/locale/es_ar.inc");
            $this->_message_arr = array_merge($en_message_ar, $es_message_ar);

        }

        /**
         * Function gets the objects current language setting
         *
         * @param
         * @access public
         *
         * @return String Objects language settings
         *
         */
        public function getLanguage() {
            return $this->_language;

        }

        /**
         * Function gets the objects current country setting
         *
         * @param
         * @access public
         *
         * @return String Objects country settings
         *
         */
        public function getCountry() {
            return $this->_country;

        }

    }

    // instantiate a new language object
    $language = new Language();

?>
