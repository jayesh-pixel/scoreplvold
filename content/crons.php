<?php
	require_once ('configs/config.php');
	require_once (SCRIPTS_DIR . 'tspl/upload.php');
	require_once (SCRIPTS_DIR . 'tspl/DB3.php');
	set_time_limit(0);
	class crons {
		function crons() {
			
		}
		
		function allCrons(){
			$this->getScheduledMatches();
			$this->getLiveMatches();
			$this->getCompletedMatches();
			$this->updatePlayersByMatch();
			// $this->updateMatchInfo();
			$this->updatePlaying11ByMatch();
		}
		
		function insertUpdateMatches($datArray = array(), $objectType){
			if($datArray){
				$update = array();
				foreach($datArray as $k => $v)
					$update[] = "$k='$v'";
				
				$query = "insert into {$objectType}(" . join(',', array_keys($datArray)) . ") values('" . join("','", array_values($datArray)) . "') ON DUPLICATE KEY UPDATE " . join(',', $update) . ", id=LAST_INSERT_ID(id);";
				tspl_query($query);
				
				$id = tspl_insert_id();
				
				return $id;
			}
		}
		
		function getLiveMatches(){
			global $entityToken;
			$url = "https://rest.entitysport.com/v2/matches/?status=3&token={$entityToken}&per_page=50";
			$response = getCurlResponse($url);
			//print_r($url);die;
			if(@$response)
			{
				$data = json_decode($response, 1);
				if($items = @$data['response']['items']){
					foreach ($items as $key => $item) {
						$matchArray = array(
							'cid' => $item['competition']['cid'],
							'match_id' => $item['match_id'],
							'title' => tspl_escape_string($item['title']),
							'short_title' => tspl_escape_string($item['short_title']),
							'format' => $item['format'],
							'format_str' => $item['format_str'],
							'status' => $item['status'],
							'status_str' => $item['status_str'],
							'status_note' => $item['status_note'],
							'date_start' => date("Y-m-d H:i:s", strtotime('+5 hour +30 minutes', strtotime($item['date_start']))),
							'date_end' => date("Y-m-d H:i:s", strtotime('+5 hour +30 minutes', strtotime($item['date_end']))),
						);
						
						$id = $this->insertUpdateMatches($matchArray, 'matches');
						
						$teama = $item['teama'];
						$teamb = $item['teamb'];
						
						$teamaArray = array(
							'mid' => $id,
							'match_id' => $item['match_id'],
							'team_id' => $teama['team_id'],
							'name' => tspl_escape_string($teama['name']),
							'short_name' => tspl_escape_string($teama['short_name']),
							'logo_url' => $teama['logo_url'],
							'scores' => $teama['scores'],
							'overs' => $teama['overs']
						);
						
						$teambArray = array(
							'mid' => $id,
							'match_id' => $item['match_id'],
							'team_id' => $teamb['team_id'],
							'name' => tspl_escape_string($teamb['name']),
							'short_name' => tspl_escape_string($teamb['short_name']),
							'logo_url' => $teamb['logo_url'],
							'scores' => $teamb['scores'],
							'overs' => $teamb['overs']
						);
						
						$this->insertUpdateMatches($teamaArray, 'teams');
						$this->insertUpdateMatches($teambArray, 'teams');
					}
				}
			}
		}

		function updateMatchInfo(){
			
			$matches = getRecords($query = "select group_concat(u.device_token) as device_token, m.* from matches m, my_teams mt, user u where date_sub(m.date_start, INTERVAL 30 MINUTE) <= NOW() and m.date_start>=NOW() and m.id=mt.match_id and mt.deleted=0 and u.id=mt.userid group by m.id;");
			
			require_once(BASE_PATH . "content/fcm.php");
			$fcm = new FCM();
				
			foreach ($matches as $key => $value) {
				$deviceIds = array_filter(explode(",", $value['device_token']));
				$data = array('title' => "Lineup Started", 'message' => $value['title'] . ' - Lineup Started');
				if(count($deviceIds)){
					$fcm->send_notification($data, $deviceIds);
				}
			}
			
			$query = "update matches set lineupavailable=1 where date_sub(date_start, INTERVAL 30 MINUTE) <= NOW() and date_start>=NOW();";
			tspl_query($query);
			
			$query = "update matches set lineupavailable=0 where date_start<=NOW();";
			tspl_query($query);
			
			$query = "update matches set status_str='Completed', status=2 where date_end < NOW() and status_str!='Completed';";
			tspl_query($query);
			
			$this->updateScorecardByMatch();
		}
		
		function updatePlaying11ByMatch(){
			$matches = getRecords($query = "select m.* from matches m where ((date_sub(m.date_start, INTERVAL 30 MINUTE) <= NOW() and m.date_start>=NOW()) or (m.date_start<NOW() and m.date_end > Now()));");
			
			foreach ($matches as $key => $value) 
				$this->updatePlaying11($value['match_id']);
		}
		
		function getScheduledMatches(){
			global $entityToken;
			$url = "https://rest.entitysport.com/v2/matches/?status=1&token={$entityToken}&per_page=50";
			$response = getCurlResponse($url);
			
			if(@$response)
			{
				$data = json_decode($response, 1);
				if($items = @$data['response']['items']){
					foreach ($items as $key => $item) {
						$matchArray = array(
							'cid' => $item['competition']['cid'],
							'match_id' => $item['match_id'],
							'title' => tspl_escape_string($item['title']),
							'short_title' => tspl_escape_string($item['short_title']),
							'format' => $item['format'],
							'format_str' => $item['format_str'],
							'status' => $item['status'],
							'status_str' => $item['status_str'],
							'status_note' => $item['status_note'],
							'date_start' => date("Y-m-d H:i:s", strtotime('+5 hour +30 minutes', strtotime($item['date_start']))),
							'date_end' => date("Y-m-d H:i:s", strtotime('+5 hour +30 minutes', strtotime($item['date_end']))),
						);
						
						$id = $this->insertUpdateMatches($matchArray, 'matches');
						
						$teama = $item['teama'];
						$teamb = $item['teamb'];
						
						$teamaArray = array(
							'mid' => $id,
							'match_id' => $item['match_id'],
							'team_id' => $teama['team_id'],
							'name' => tspl_escape_string($teama['name']),
							'short_name' => tspl_escape_string($teama['short_name']),
							'logo_url' => $teama['logo_url'],
							'scores' => $teama['scores'],
							'overs' => $teama['overs']
						);
						
						$teambArray = array(
							'mid' => $id,
							'match_id' => $item['match_id'],
							'team_id' => $teamb['team_id'],
							'name' => tspl_escape_string($teamb['name']),
							'short_name' => tspl_escape_string($teamb['short_name']),
							'logo_url' => $teamb['logo_url'],
							'scores' => $teamb['scores'],
							'overs' => $teamb['overs']
						);
						
						$this->insertUpdateMatches($teamaArray, 'teams');
						
						$this->insertUpdateMatches($teambArray, 'teams');
					}
				}
			}
		}

		function getMatchInfo(){
			global $entityToken;
			$url = "https://rest.entitysport.com/v2/matches/65775/info?token={$entityToken}";
			$response = getCurlResponse($url);
			
			if(@$response)
			{
				$data = json_decode($response, 1);
				debug($data); die;
			}
			
		}

		function getCompletedMatches(){
			global $entityToken;
			$url = "https://rest.entitysport.com/v2/matches/?status=2&token={$entityToken}&per_page=50";
			$response = getCurlResponse($url);
			
			if(@$response)
			{
				$data = json_decode($response, 1);
				if($items = @$data['response']['items']){
					foreach ($items as $key => $item) {
						$matchArray = array(
							'cid' => $item['competition']['cid'],
							'match_id' => $item['match_id'],
							'title' => tspl_escape_string($item['title']),
							'short_title' => tspl_escape_string($item['short_title']),
							'format' => $item['format'],
							'format_str' => $item['format_str'],
							'status' => $item['status'],
							'status_str' => $item['status_str'],
							'status_note' => $item['status_note'],
							'date_start' => date("Y-m-d H:i:s", strtotime('+5 hour +30 minutes', strtotime($item['date_start']))),
							'date_end' => date("Y-m-d H:i:s", strtotime('+5 hour +30 minutes', strtotime($item['date_end']))),
						);
						
						$id = $this->insertUpdateMatches($matchArray, 'matches');
					}
				}
			}
			
			$this->updateScorecardByMatch();
		}

		function updatePlayersByMatch(){
			$matches = getRecords($query = "select match_id, cid from matches where deleted=0 and status in (3, 1);");
			foreach ($matches as $key => $match) {
				$this->getPlayersByMatchId($match['match_id'], $match['cid']);
			}
		}

		function updateUserBalance(){
			$matches = getRecords($query = "select m.id, m.match_id, c.cid as cid, m.title from matches m, user_contests c where m.deleted=0 and m.status=2 and m.distributed=0 and c.match_id=m.id order by m.id desc;");
			
			foreach ($matches as $key => $match) {
				$teams = $this->getUsersRankByMatchId($match['id'], $match['cid']);
				
				foreach ($teams as $team) {
					if(floatval($team['amount']) > 0){
						$ids = explode(",", $team['userIds']);
						
						foreach ($ids as $key => $id) {
							$query = "update user set balance=balance+'{$team['amount']}' where id in('{$id}');";
							tspl_query($query);
							
							$query = "insert into transactions(type, amount, userid, date, remark) values('credit', '{$team['amount']}', '{$id}', curdate(), 'Winning amount against {$match['title']}');";
							tspl_query($query);
						}
					}
				}
	
				$query = "update matches set distributed=1 where id in('{$match['id']}');";
				tspl_query($query);
			}
		}
	
		function getUsersRankByMatchId($mid = 0, $cid = 0){
			$teams = getRecords($query = "select t.points, count(t.id) as userCount, group_concat(u.id) as userIds, u.name from my_teams t, user u where t.match_id='{$mid}' and t.cid='{$cid}' and t.deleted=0 and t.userid=u.id group by t.points order by t.points desc;");
			$rank = 1;
			
			foreach ($teams as &$team) {
				$rule = getRecord($query = "select * from contest_rules where cid='{$cid}' and deleted=0 and min_rank >= {$rank} and max_rank <= {$rank};");
				
				$team['amount'] = floatval($rule['amount']) / intval($team['userCount']);
				$team['rank'] = $rank;
				
				$rank++;
			}
			
			return $teams;
		}
		
		function updateScorecardByMatch(){
			$matches = getRecords($query = "select m.id, m.match_id, m.cid, m.format from matches m, user_contests u where m.deleted=0 and m.status in(2, 3) and m.calculated=0 and u.match_id=m.id group by m.id limit 5;");
			// and m.calculated=0
			foreach ($matches as $key => $match) {
				$this->getScorecardByMatchId($match['match_id']);
				$this->updateUserPoints($match['id'], $match['format']);
			}
			// require_once(BASE_PATH . 'content/api.php');
			// $api = new api();
			// $api->updateUserBalance();
		}
		
		function updateUserPoints($mid = 0, $format = 0){
			$points = getRecords($query = "select * from points where deleted=0 and match_format='{$format}';");
			
			$pointsArr = array();
			foreach ($points as $key => $point) {
				$pointsArr[$point['point_key']] = floatval($point['points']);
			}
			
			$users = getRecords($query = "select * from user_contests where match_id='{$mid}';");
			$match = getRecord($query = "select * from matches where id='{$mid}';");
			
			foreach ($users as $key => $user) {
				$teams = getRecords($query = "select * from my_teams where match_id='{$mid}' and userid='{$user['userid']}';");
				foreach ($teams as $key => $team) {
					$players = getRecords($query = "select p.pid, p.fantasy_player_rating, t.*, m.match_id from my_team_players t, matches m, players p where t.match_id='{$mid}' and t.userid='{$team['userid']}' and t.deleted=0 and m.id=t.match_id and t.player_id=p.id;");
					
					foreach ($players as $key => $player) {
						$total = 0;
						$batsmen = getRecord($query = "select runs, balls_faced, fours, sixes, run1, run2, run3, run5 from batsmens where match_id='{$match['match_id']}' and batsman_id='{$player['pid']}'");
						
						foreach ($pointsArr as $key => $point) {
							$playerPoint = (floatval($batsmen[$key]) * floatval($point));
							
							if($player['captain'])
								$playerPoint += $playerPoint * 2;
							else if($player['vice_captain'])
								$playerPoint += $playerPoint * 1.5;
							
							$total += $playerPoint;
						}
						
						$bowler = getRecord($query = "select maidens, runs_conceded, wickets, noballs, wides, run0, bowledcount, lbwcount from bowlers where match_id='{$match['match_id']}' and bowler_id='{$player['pid']}'");
						
						foreach ($pointsArr as $key => $point) {
							$playerPoint = (floatval($bowler[$key]) * floatval($point));
							
							if($player['captain'])
								$playerPoint += $playerPoint * 2;
							else if($player['vice_captain'])
								$playerPoint += $playerPoint * 1.5;
							
							$total += $playerPoint;
						}
						
						$fielder = getRecord($query = "select catches, runout_thrower, runout_catcher, runout_direct_hit, stumping from fielders where match_id='{$match['match_id']}' and fielder_id='{$player['pid']}'");
						
						foreach ($pointsArr as $key => $point) {
							$playerPoint = (floatval($fielder[$key]) * floatval($point));
							
							if($player['captain'])
								$playerPoint += $playerPoint * 2;
							else if($player['vice_captain'])
								$playerPoint += $playerPoint * 1.5;
							
							$total += $playerPoint;
						}
						
						$query = "update my_team_players set points='{$total}' where id='{$player['id']}' and match_id='{$mid}';";
						tspl_query($query);
					}
					
					$teamPoints = getRecordField($query = "select SUM(t.points) as total from my_team_players t, players p where t.match_id='{$mid}' and t.userid='{$team['userid']}' and t.deleted=0 and t.player_id=p.id;");
					
					$query = "update my_teams set points='{$teamPoints}' where id='{$team['id']}';";
					tspl_query($query);
				}
			}
			
			if(intval($match['status']) == 2){
				$query = "update matches set calculated=1 where id='{$mid}';";
				tspl_query($query);
				
				$this->updateUserBalance();
			}
		}

		function getPlayersByMatchId($mid = 0, $cid = 0){
			global $entityToken;
			if(!$cid)
				$cid = intval($_REQUEST['cid']);
			
			if(!$mid)
				$mid = intval($_REQUEST['mid']);
			
			if($cid && $mid){
				$url = "https://rest.entitysport.com/v2/competitions/{$cid}/squads/{$mid}?token={$entityToken}";
				$response = getCurlResponse($url);
			
				if(@$response)
				{
					$data = json_decode($response, 1);
				// 	debug($data); die;
					if($squads = @$data['response']['squads']){
						foreach ($squads as $key => $squad) {
							foreach ($squad['players'] as $key => $player) {
								$playerArray = array(
									'team_id' => intval($squad['team_id']),
									'pid' => intval($player['pid']),
									'title' => tspl_escape_string($player['title']),
									'short_name' => tspl_escape_string($player['short_name']),
									'country' => $player['country'],
									'playing_role' => $player['playing_role'],
									'fantasy_player_rating' => floatval($player['fantasy_player_rating']),
									'imgpath' => 'upload/players/default.png',
									'mid' => $mid
								);
								
								$id = $this->insertUpdateMatches($playerArray, 'players');
							}
						}
					}
				}
			}
		}

		function updatePlaying11($mid = 0){
			global $entityToken;
			if($mid){
				$url = "https://rest.entitysport.com/v2/matches/{$mid}/squads?token={$entityToken}";
				$response = getCurlResponse($url);
			
				if(@$response)
				{
					$data = json_decode($response, 1);
					foreach ($data['response']['teama']['squads'] as $key => $value) {
						$query = "update players set playing11={$value['playing11']} where pid='{$value['player_id']}' and team_id='{$data['response']['teama']['team_id']}' and mid='{$mid}';";
						tspl_query($query);
						
						if(!$value['playing11']){
							$players = getRecords($query = "select tp.team_id, tp.match_id, tp.id from player p, my_team_players tp, matches m where p.pid='{$value['player_id']}' and p.mid='{$mid}' and m.match_id=p.mid and p.id=tp.palyer_id and tp.backup=0 and m.id=tp.match_id group by p.team_id;");
							foreach ($players as $key => $player) {
								$bplayers = getRecord($query = "select * from my_team_players where team_id='{$player['team_id']}' and backup=1 and match_id='{$player['match_id']}' limit 1;");
								
								$cplayer = getRecord($query = "select * from my_team_players where team_id='{$player['team_id']}' and backup=0 and match_id='{$player['match_id']}' limit 1;");
								
								$query = "update my_team_players set backup=0 where id='{$bplayers['id']}';";
								tspl_query($query);
								
								$query = "update my_team_players set backup_player='{$bplayers['id']}' where id='{$player['id']}';";
								tspl_query($query);
							}
						}
					}

					foreach ($data['response']['teamb']['squads'] as $key => $value) {
						$query = "update players set playing11={$value['playing11']} where pid='{$value['player_id']}' and team_id='{$data['response']['teamb']['team_id']}' and mid='{$mid}';";
						tspl_query($query);
						
						if(!$value['playing11']){
							$players = getRecords($query = "select tp.team_id, tp.match_id, tp.id from player p, my_team_players tp, matches m where p.pid='{$value['player_id']}' and p.mid='{$mid}' and m.match_id=p.mid and p.id=tp.palyer_id and tp.backup=0 and m.id=tp.match_id group by p.team_id;");
							foreach ($players as $key => $player) {
								$bplayers = getRecord($query = "select * from my_team_players where team_id='{$player['team_id']}' and backup=1 and match_id='{$player['match_id']}' limit 1;");
								
								$cplayer = getRecord($query = "select * from my_team_players where team_id='{$player['team_id']}' and backup=0 and match_id='{$player['match_id']}' limit 1;");
								
								$query = "update my_team_players set backup=0 where id='{$bplayers['id']}';";
								tspl_query($query);
								
								$query = "update my_team_players set backup_player='{$bplayers['id']}' where id='{$player['id']}';";
								tspl_query($query);
							}
						}
					}
				}
			}
		}

		function getScorecardByMatchId($mid = 0){
			global $entityToken;
			if(!$mid)
				$mid = intval($_REQUEST['mid']);
			
			if($mid){
				$url = "https://rest.entitysport.com/v2/matches/{$mid}/scorecard?token={$entityToken}";
				$response = getCurlResponse($url);
			
				if(@$response)
				{
					$data = json_decode($response, 1);
					if($response = @$data['response']){
						$innings = $response['innings'];
						foreach ($innings as $key => $inning) {
							$batsmens = $inning['batsmen'];
							foreach ($batsmens as $key => $batsmen) {
								$batsmenArray = array(
									'iid' => intval($inning['iid']),
									'match_id' => intval($response['match_id']),
									'name' => tspl_escape_string($batsmen['name']),
									'batsman_id' => intval($batsmen['batsman_id']),
									'batting' => $batsmen['batting'],
									'position' => $batsmen['position'],
									'role' => $batsmen['role'],
									'role_str' => $batsmen['role_str'],
									'runs' => intval($batsmen['runs']),
									'balls_faced' => intval($batsmen['balls_faced']),
									'fours' => intval($batsmen['fours']),
									'sixes' => intval($batsmen['sixes']),
									'run0' => intval($batsmen['run0']),
									'run1' => intval($batsmen['run1']),
									'run2' => intval($batsmen['run2']),
									'run3' => intval($batsmen['run3']),
									'run5' => intval($batsmen['run5']),
									'how_out' => tspl_escape_string($batsmen['how_out']),
									'dismissal' => $batsmen['dismissal'],
									'strike_rate' => floatval($batsmen['strike_rate']),
									'bowler_id' => intval($batsmen['bowler_id']),
									'first_fielder_id' => intval($batsmen['first_fielder_id']),
									'second_fielder_id' => intval($batsmen['second_fielder_id']),
									'third_fielder_id' => intval($batsmen['third_fielder_id'])
								);
								
								$id = $this->insertUpdateMatches($batsmenArray, 'batsmens');
							}

							$bowlers = $inning['bowlers'];
							foreach ($bowlers as $key => $bowler) {
								$bowlersArray = array(
									'iid' => intval($inning['iid']),
									'match_id' => intval($response['match_id']),
									'name' => tspl_escape_string($bowler['name']),
									'bowler_id' => intval($bowler['bowler_id']),
									'bowling' => $bowler['bowling'],
									'position' => $bowler['position'],
									'overs' => floatval($bowler['overs']),
									'maidens' => intval($bowler['maidens']),
									'runs_conceded' => intval($bowler['runs_conceded']),
									'wickets' => intval($bowler['wickets']),
									'noballs' => intval($bowler['noballs']),
									'wides' => intval($bowler['wides']),
									'econ' => floatval($bowler['econ']),
									'run0' => intval($bowler['run0']),
									'bowledcount' => intval($bowler['bowledcount']),
									'lbwcount' => intval($bowler['lbwcount'])
								);
								
								$id = $this->insertUpdateMatches($bowlersArray, 'bowlers');
							}
							
							$fielders = $inning['fielder'];
							foreach ($fielders as $key => $fielder) {
								$fieldersArray = array(
									'iid' => intval($inning['iid']),
									'match_id' => intval($response['match_id']),
									'fielder_name' => tspl_escape_string($fielder['fielder_name']),
									'fielder_id' => intval($fielder['fielder_id']),
									'catches' => intval($fielder['catches']),
									'runout_thrower' => intval($fielder['runout_thrower']),
									'runout_catcher' => intval($fielder['runout_catcher']),
									'runout_direct_hit' => intval($fielder['runout_direct_hit']),
									'stumping' => intval($fielder['stumping']),
									'is_substitute' => $fielder['is_substitute'],
								);
								
								$id = $this->insertUpdateMatches($fieldersArray, 'fielders');
							}
						}
					}
				}
			}
		}
	}
?>