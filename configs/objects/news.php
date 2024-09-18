<?php

	function list_news($id){
		global $row;
		if($id)
		{
			$row['likes'] = getRecordField($query = "select count(id) as cnt from news_likes where news='{$id}' and liked=1;");
			$row['news_comments'] = getRecordField($query = "select count(id) as cnt from news_comments where news='{$id}' and deleted=0;");
		}
	}
	
	function edit_news($id){
		global $session, $userid;
		if(count(@$_REQUEST['imgpath']))
		{
			$ids = array();
			foreach ($_REQUEST['imgpath'] as $key => $value) {
				if($value)
				{
					$values = array(
						'id' => $key,
						'news' => intval(@$id),
						'imgpath' => tspl_escape_string($value)
					);
					$ids[] = DB3::updateObject('news_images', $values);
				}
			}
			
			if($ids)
			{
				$query = "update news_images set deleted=1 where news='{$id}' and deleted=0 and id not in(" . join(",", $ids) . ");";
				tspl_query($query);
			}
		}
		else{
			$query = "update news_images set deleted=1 where news='{$id}' and deleted=0;";
			tspl_query($query);
		} 
	}
	
	function editor_news($id){
		global $session, $smarty;
		if($id)
		{
			$smarty->assign('images', $images = getRecords($query = "select * from news_images where news='{$id}' and deleted=0;"));
			$smarty->assign('videos', getRecords($query = "select * from news_videos where news='{$id}' and deleted=0;"));
		}
	}
	
	function details_news($id){
		global $session, $smarty;
		if($id)
		{
			$smarty->assign('images', $images = getRecords($query = "select * from news_images where news='{$id}' and deleted=0;"));
			$smarty->assign('video', getRecords($query = "select * from news_videos where news='{$id}' and deleted=0;"));
		}
	}
	
	$objects['news'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'News',
			'plural' => 'News',
			'table' => 'news',
			'default_sort_field' => 'id',
			'default_sort_order' => 'asc',
			'add' => true,
			'edit' => true,
			'search' => true,
			'details' => true,
			'delete' => true,
			'fullpage' => true,
			'editor' => 'manager/edit_news.tpl',
			'viewer' => 'manager/news_details.tpl',
			'filter' => "deleted=0",
			'row_actions' => array(
			        array(
    					'link' => "javascript: sendNotification(ID);",
    					'title' => 'Send Notification',
    					'text' => 'Send Notification',
    					'icon' => 'fas fa-bell'
    				),
			    )
		),
		'fields' => array(
			'title' => array(
				'displayname' => 'News Name',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'required',
			),
			/*
			'tags' => array(
				'displayname' => '# Tags',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
			),
			*/
			'lang' => array(
				'displayname' => 'Language',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => DB3::findChildren('languages', 'name', array(), "deleted=0"),
				'assoc' => true,
				'validation' => 'required',
			),
			'category' => array(
				'displayname' => 'Category',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => DB3::findChildren('categories', 'name', array(), "deleted=0"),
				'assoc' => true,
				'validation' => 'required',
			),
			'publish' => array(
				'displayname' => 'Publish',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'validation' => 'required',
				'options' => array('1' => 'Yes', '0' => 'No')
			),
			'news' => array(
				'displayname' => 'News',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'textarea',
				'rows' => 10,
				'cols' => 15,
				'validation' => 'required'
			),
			'videopath' => array(
				'displayname' => 'Video',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'file',
				'extention' => array('mp4', 'wav', 'mp3'),
				'path' => 'upload/news/',
				'filetype' => 'video'
			),
			'news_comments' =>  array(
				'displayname' => 'Total Comments',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
			),
			'likes' =>  array(
				'displayname' => 'Likes',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
			),
		)
	);
?>
