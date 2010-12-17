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
//require_once("../internationalisation/messages.php");

/**
 * Language class is a template for Language objects.
 *
 * Copyright 	(c) 2010 Tom Kaczocha
 *
 * @package         
 * @author		Tom Kaczocha <tomk@resultsfocus.com.au>
 * @copyright	2010 Tom Kaczocha
 * @licence
 * @version 	1.0
 * @access		public
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

    public function __construct($language = "en", $country="us") {

        $this->setLocale($language, $country);
    }

    public function __destruct() {
        
    }

    public function setLocale($language, $country) {
        $this->_language = $language;
        $this->_country = $country;
    }

    public function translate($message) {
        include(LOCALE_PATH . DS . $this->_language . "_" . $this->_country . ".inc");
        return $$message;
    }

    public function getLanguage() {
        return $this->_language;
    }

    public function getCountry() {
        return $this->_country;
    }
}

$language = new Language();
?>
