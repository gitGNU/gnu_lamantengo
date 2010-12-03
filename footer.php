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
	if(defined('INSITE')){
		?>
		<div id="footer">
			<a href="http://www.lamantengo.com.ar/" title="LaMantengo.Com.Ar">LaMantengo.Com.Ar</a> - &copy;2010 <a href="http://www.unwebmaster.com.ar" title="Idea y realizaci&oacute;n: UnWebMaster.Com.Ar">UnWebMaster</a><br />
			<a href="tos.php<?php if($sid) echo "?sid=".$sid; ?>" title="Leer las Condiciones del servicio">Condiciones del servicio</a>
		</div>
	</body>
</html>
		<?php
	}else{
		include("404.php");
	}
?>