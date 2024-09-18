<?php
	$smarty->assign('meta', array(
		'title' => "Search Results",
		'description' => "$sitename_caps Search",
		'keywords' => $sitename_caps
	));

	require('content/header.php');
	require('content/footer.php');
	require_once(SCRIPTS_DIR . 'simplehtmldom/simple_html_dom.php');
	
	$html = file_get_html("https://www.dream11.com/games/fantasy-cricket/how-to-play");
	$contents = "";
	
	foreach($html->find('div.htp_tab_outer') as $key => $p_tags) {
	    $p_tags->{'style'} = "display:none;";
	}
	
	foreach($html->find('div.header > a') as $key => $p_tags) {
	    $p_tags->{'style'} = "display:none;";
	}
	
	foreach($html->find('div.how_to_play_universal_banner > div.back_arrow') as $key => $p_tags) {
	    $p_tags->{'style'} = "display:none;";
	}
	
	foreach ($html->find('body') as $e)
		$contents = $e -> outertext;
	
	$smarty->assign('html', $contents);
	
	$smarty->display('rules.tpl');
?>