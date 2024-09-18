<?php /* Smarty version Smarty-3.1.13, created on 2023-10-19 13:35:07
         compiled from "/home/u233274077/domains/adminapp.tech/public_html/crickapp/templates/rules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6369498036530e333c55005-22734808%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e8a195f70cee1aab1c1b8683e45c9cf08c13af9' => 
    array (
      0 => '/home/u233274077/domains/adminapp.tech/public_html/crickapp/templates/rules.tpl',
      1 => 1689764470,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6369498036530e333c55005-22734808',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'settings' => 0,
    'html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_6530e333c5ab42_42983626',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6530e333c5ab42_42983626')) {function content_6530e333c5ab42_42983626($_smarty_tpl) {?><head>
	<script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script gtm="GTM-TX3HC37" type="text/javascript" async="" src="https://www.google-analytics.com/gtm/optimize.js?id=GTM-52R6HK9"></script><script type="text/javascript" async="" src="https://d11-web-sdk.Fab11.com/sdk/data-highway-sdk/latest"></script><script async="" src="https://www.googletagmanager.com/gtm.js?id=GTM-TX3HC37"></script>
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start' : new Date().getTime(),
				event : 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-TX3HC37');
	</script>
	<!-- End Google Tag Manager -->
	<script>
		;(function() {
			var queue = []
			window.D11Data = D11Data = window.D11Data || {}
			window.D11DataQueue = queue;
			['init', 'track'].forEach(function(methodName) {
				D11Data[methodName] = function() {
					queue.push({
						method : methodName,
						args : arguments
					})
				}
			})
			var s = document.createElement('script')
			s.type = 'text/javascript'
			s.async = true
			s.src = 'https://d11-web-sdk.Fab11.com/sdk/data-highway-sdk/latest'
			var x = document.getElementsByTagName('script')[0]
			x.parentNode.insertBefore(s, x)
		})()
		D11Data.init({
			appName : 'com.app.Fab11Pwa'
		})
	</script>
	<script>
		D11Data.track('PageLoaded', {
			page : 'Home'
		})
		window.onload = function() {
			document.getElementById('cricket_create_team_title').onclick = function() {
				D11Data.track('CreateYourTeamCricketAccrodionClicked', {
					page : 'HowToPlayCricket',
					platform : 'pwa'
				})
			}
			document.getElementById('cricket_points_system_title').onclick = function() {
				D11Data.track('CricketPointsSystemAccrodionClicked', {
					page : 'HowToPlayCricket',
					platform : 'pwa'
				})
			}
			document.getElementById('cricket_other_points_title').onclick = function() {
				D11Data.track('CricketOtherPointsAccrodionClicked', {
					page : 'HowToPlayCricket',
					platform : 'pwa'
				})
			}
		}
	</script>
	<link rel="shortcut icon" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['settings']->value['favicon'];?>
">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['settings']->value['favicon'];?>
">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link rel="canonical" href="https://www.Fab11.com/fantasy-cricket/how-to-play-fantasy">
	<title>How to Play Fantasy Cricket</title>
	<meta name="description" content="Create your Fab11 to join contests and win real cash in fantasy cricket.">
	<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
styles/htp-kabaddi.css">
	<!-- <link type='text/css' rel='stylesheet' href='htp-kabaddi.css' /> -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet">
	<!-- <h2 class="loaderHide" style="text-align:center; margin:10% 0;">Loading...</h2> -->
	<script type="text/javascript" src="https://d13ir53smqqeyp.cloudfront.net/d11-static-pages/js/jquery-1.11.1.min.js"></script>
	<style>
		.htp_content_box iframe {
			width: 90%;
			height: 300px;
			border-radius: 12px;
			margin: 0 auto 24px auto;
			display: block;
		}
		.otherinfo_subpoint {
			padding-left: 25px !important;
			padding-top: 12px !important;
		}
		.otherinfo_subpoint li {
			font-size: 16px;
			line-height: 22px;
			color: #1a1a1a;
			margin-bottom: 24px;
			display: block;
		}
		.football-note {
			font-weight: 400;
			font-size: 16px;
			line-height: 22px;
			text-align: left;
			padding: 0px 24px 0px 24px;
			margin-top: 0px;
			;
		}
		.accordionContent .tabs {
			overflow: scroll;
		}
		.accordionContent .tabs a {
			padding: 12px 6px;
		}
		/* nex css for sixty tab */
		.mp0 {
			padding-top: 0;
			padding-left: 30px;
			padding-right: 30px;
		}
		.accordionContent .tabs a {
			font-size: 14px;
		}
		.mp0 p {
			margin-top: 0;
			padding-top: 0;
			font-size: 16px;
			color: #1a1a1a
		}
		.mp0 li {
			margin-bottom: 25px;
		}
		.mp0 li span {
			width: 8px;
			height: 8px;
			display: block;
			background: #000;
			float: left;
			position: relative;
			top: 7px;
			border-radius: 10px;
		}
		.mp0 li div {
			margin-left: 20px;
		}
		.mp0 ul.otherinfo {
			list-style: none;
			padding: 0
		}
		.step_box {
			margin-top: 0;
		}
		.htp_point_list > ul {
			margin-top: 0;
		}
		.backups {
			margin-top: 30px;
		}
		.backups a {
			text-decoration: none;
			font-weight: normal;
			color: #2072E4;
		}
		@media (max-width: 550px) {
			.htp_content_box iframe {
				height: 174px;
				border-radius: 8px;
				width: 100%;
			}
			.football-note {
				padding: 0px 24px 16px 24px;
				font-size: 14px;
				line-height: 20px;
				margin-top: 0px;
				margin-bottom: 0px;
			}
			.otherinfo_subpoint li {
				font-size: 14px;
				line-height: 20px;
			}
		}
	</style>
	<meta http-equiv="google-site-verification" content="h6JUgqX9dMFO0C4E5VqUOBK7lb6vuDQOyebWaxUzBEc">
</head>
	<?php echo $_smarty_tpl->tpl_vars['html']->value;?>

<?php }} ?>