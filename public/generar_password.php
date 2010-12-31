<?php

    /**
     * @License(name="GNU General Public License", version="3.0")
     *
     * Copyright (C) 2010 UnWebmaster.Com.Ar
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
    if (defined('INSITE')) {

        function generar_pass() {
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

    }
    else {
        include("404.php");
    }

?>