<?php
	function debug($param, $stop=false)
	{
		//debug(array_keys(get_defined_vars())); This is a function call to debug all defined variables on page.
		if(is_array($param))
		{
			echo '<div style="border: 1px solid; background-color: #BDE5F8;color: #00529B;"><strong>Debug:</strong>';
			echo '<pre>';
			print_r($param);
			echo '</pre> <br clear="all" /></div>';
			if($stop)
				die;
			return ;

		}
		echo '<div style="border: 1px solid; background-color: #BDE5F8;color: #00529B;">';
		global ${$param};
		$name = $param;
		$value = ${$param};

		if(is_array($value))
		{
			echo '<pre>';
			print_r($value);
			echo '</pre> <br clear="all" />';

		}
		else
		{
			echo '<br /><strong>' . $name . '</strong> = ' . $value;
			echo ' <br clear="all" />';
		}
		echo '</div>';

		if($stop)
			die;
	}
?>