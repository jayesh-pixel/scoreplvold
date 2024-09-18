<?php
	require_once(SMARTY_DIR . 'Smarty.class.php');

	class TSPLSmarty extends Smarty
	{
		function TSPLSmarty()
		{
		    $this->__construct();

			$this->template_dir = SMARTY_ROOT . 'templates/';
			$this->compile_dir  = SMARTY_ROOT . 'templates_c/';
			$this->config_dir   = SMARTY_ROOT . 'configs/';
			$this->cache_dir    = SMARTY_ROOT . 'cache/';
		}

		// Replacement function for _read_file() in Smarty.class.php to add support
		// for reading both ionCube encrypted templates and plain text templates.
		// Smarty.class.php must be encoded by the creator of the templates for
		// ioncube_read_file() to decode encrypted template files
		function _read_file($filename)
		{
			$res = false;

			if (file_exists($filename)) {
				if (function_exists('ioncube_read_file')) {
					$res = ioncube_read_file($filename);
					if (is_int($res)) $res = false;
				}
				else if ( ($fd = @fopen($filename, 'rb')) ) {
					$res = ($size = filesize($filename)) ? fread($fd, $size) : '';
					fclose($fd);
				}
			}

			return $res;
		}

/*		function fetch($_smarty_tpl_file, $_smarty_cache_id = null, $_smarty_compile_id = null, $_smarty_display = false)
		{
			global $userid;
			if($_smarty_cache_id)
				$_smarty_cache_id = $userid . $_smarty_cache_id;

			// Now call parent method
			return parent::fetch( $_smarty_tpl_file, $_smarty_cache_id, $_smarty_compile_id, $_smarty_display );
		}

		function is_cached($tpl_file, $cache_id = null, $compile_id = null)
		{
			global $userid;
			if (!$this->caching)
				return false;

			if($cache_id)
				$cache_id = $userid . $cache_id;
			return parent::is_cached($tpl_file, $cache_id, $compile_id);
		}

		function clear_cache($tpl_file = null, $cache_id = null, $compile_id = null, $exp_time = null)
		{
			global $userid;
			if(!$tpl_file)
				return parent::clear_cache();

			if (!$this->caching)
				return false;

			if($cache_id)
				$cache_id = $userid . $cache_id;

			return parent::clear_cache($tpl_file, $cache_id, $compile_id);
		}

	    function display($resource_name, $cache_id = null, $compile_id = null)
	    {
			global $userid;
			if($cache_id)
				$cache_id = $userid . $cache_id;
			return parent::display($resource_name, $cache_id, $compile_id);
	    }*/
	}
?>