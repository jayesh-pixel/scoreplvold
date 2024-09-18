<?php
	session_start();
	require('../configs/config.php');

	if(!defined("PATH_SEPARATOR"))
		if(strpos($_ENV["OS"],"Win") !== false)
			define("PATH_SEPARATOR", ";");
		else
			define("PATH_SEPARATOR", ":");

	set_include_path(SCRIPTS_DIR . 'minify/lib' . PATH_SEPARATOR . get_include_path());

	require('Minify.php');
	if(!$testsite)
		Minify::useServerCache(SCRIPTS_DIR . '../upload/tmp');

	$serveOptions = array (
		'groups' => array (
			'jsdev' => array('../scripts/global.js', '../scripts/app.js', '../scripts/paging.js'),
			'cssdev' => array('../styles/global.css', '../styles/jquery-ui-1.10.0.custom.min.css', '../styles/jquery.ui.timepicker.css', '../styles/app.css'),
			'js' => array(
				'../scripts/jquery.min.js',
				'../scripts/global.js',
				'../scripts/app.js', 
				'../scripts/paging.js',
				"../assets/vendors/js/vendor.bundle.base.js",
				"../assets/vendors/chart.js/Chart.min.js",
				"../assets/vendors/progressbar.js/progressbar.min.js",
				"../assets/vendors/jvectormap/jquery-jvectormap.min.js",
				"../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js",
				"../assets/vendors/owl-carousel-2/owl.carousel.min.js",
				"../assets/js/off-canvas.js",
				"../assets/js/hoverable-collapse.js",
				"../assets/js/misc.js",
				"../assets/js/settings.js",
				"../assets/js/todolist.js",
				"../assets/js/dashboard.js",
				"../scripts/bootstrap-fileinput/js/plugins/piexif.js",
				"../scripts/bootstrap-fileinput/js/plugins/sortable.js",
				"../scripts/bootstrap-fileinput/js/fileinput.js",
				"../scripts/bootstrap-fileinput/js/locales/fr.js",
				"../scripts/bootstrap-fileinput/js/locales/es.js",
				"../scripts/bootstrap-fileinput/themes/fas/theme.js",
				"../scripts/bootstrap-fileinput/themes/explorer-fas/theme.js",
				"../scripts/jquery.inputmask.bundle.min.js",
				"../scripts/jquery.form.js",
				"../scripts/cleditor/jquery.cleditor.min.js",
				"../assets/jquery.validate.js",
				"../assets/additional-methods.js",
			),
			'css' => array(
				"../assets/vendors/mdi/css/materialdesignicons.min.css",
				"../assets/vendors/css/vendor.bundle.base.css",
				"../assets/vendors/jvectormap/jquery-jvectormap.css",
				"../assets/vendors/flag-icon-css/css/flag-icon.min.css",
				"../assets/vendors/owl-carousel-2/owl.carousel.min.css",
				"../assets/vendors/owl-carousel-2/owl.theme.default.min.css",
				"../scripts/bootstrap-fileinput/css/fileinput.css",
				"../scripts/cleditor/jquery.cleditor.css",
				"../assets/font-awesome/css/fontawesome-all.css",
				"../assets/css/style.css",
				"../styles/app.css"
			),
		),
		'encodeOutput' => false,
		'setExpires' => $_SERVER['REQUEST_TIME'] + ($testsite?0:86400)
	);

	if(!@$loadServeOptions)
	{
		if(@$_REQUEST['test'])
		{
			error_reporting(E_ALL);
		    ini_set("display_errors", 1);

			foreach($serveOptions['groups'] as $k => $v)
				foreach($v as $jsFile)
					if(!@file_exists($jsFile))
						die($jsFile . " missing");
		}
	}
	
	global $server_url;
	if(@$_REQUEST['update'])
	{
		if($pi = substr($_SERVER['PATH_INFO'], 1) == 'js')
		{
			if(!file_exists(BASE_PATH . ASSETS_DIR . '/js/'))
				mkdir(BASE_PATH . ASSETS_DIR . '/js', 0777);
				
			file_put_contents(BASE_PATH . ASSETS_DIR . '/js/js.js', file_get_contents($server_url . "assets/min.php/js?v=3"));
		}
		elseif($pi = substr($_SERVER['PATH_INFO'], 1) == 'css')
		{
			if(!file_exists(BASE_PATH . ASSETS_DIR . '/css/'))
				mkdir(BASE_PATH . ASSETS_DIR . '/css', 0777);
			
			file_put_contents(BASE_PATH . ASSETS_DIR . '/css/css.css', file_get_contents($server_url . "assets/min.php/css?v=3"));
		}
			
		Minify::serve('Groups', $serveOptions);
	}
	else
		Minify::serve('Groups', $serveOptions);
?>