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

// define site directory structure
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

//defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'lamantengo');
// SITE_ROOT in linux
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'opt' . DS . 'lampp' . DS . 'htdocs' . DS . 'lamantengo');

// LIB_DIR
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'includes' . DS . 'classes');

// LOCALE_PATH
defined('LOCALE_PATH') ? null : define('LOCALE_PATH', SITE_ROOT . DS . 'includes' . DS . 'locale');

// IMAGE PATH if required
defined('IMAGE_PATH') ? null : define('IMAGE_PATH', '..' . DS . 'includes' . DS . 'images');


////////////////////////////////////////////////////////////////////////////////
/////////////////////////////         DEBUG          ///////////////////////////
////////////////////////////////////////////////////////////////////////////////
define('DEBUG', 1); // 1 = run UnitCheck tests; 0 = no tests run

////////////////////////////////////////////////////////////////////////////////
////////////////////////         DEFAULT LANGUAGE          /////////////////////
////////////////////////////////////////////////////////////////////////////////
define('LANGUAGE', 'en');
define('COUNTRY', 'us');

////////////////////////////////////////////////////////////////////////////////
////////////////////////      DATABASE CONFIGURATION      //////////////////////
////////////////////////////////////////////////////////////////////////////////
defined('SERVER') ? null : define('SERVER', 'localhost');
defined('DB_USER') ? null : define('DB_USER', 'root');
defined('DB_PASSWORD') ? null : define('DB_PASSWORD', 'lam123');
defined('DB_NAME') ? null : define('DB_NAME', 'lamantengo');

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

?>
