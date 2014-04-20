<html>
	<head>
		<base target="_parent"> // Links clicked in iframe will open in parent window
	</head>
	<body>
		<?php
		$timeout = 300; // 5 minutes
		$time = time();
		
		if (!isset($_GET["username"])){
			echo "Error: no username received.<br>";
			exit;
		}
		if (!isset($_GET["space"])){
			echo "Error: space name not received.<br>";
			exit;
		}
		if ($_GET["space"] == ""){
			echo "Error: space name cannot be empty.<br>";
			exit;
		}
		if (!isset($_SERVER["HTTP_REFERER"])){
			echo "Error: script cannot be called without a referer.<br>";
			exit;
		}
		$wiki_using_https = (strpos($_SERVER["HTTP_REFERER"], "https") === 0) ? true : false;
		$space = $_GET["space"];
		
		// Make sure counter is originating from the same domain it's targeting
		$url_offset = $wiki_using_https ? 8 : 7;
		if ($space != substr($_SERVER["HTTP_REFERER"], strpos($_SERVER["HTTP_REFERER"], "://") + 3, 
			strpos($_SERVER["HTTP_REFERER"], ".wikispaces.com") - $url_offset)){
			echo "Error: wikispaces-counter can only be called from the wiki it's targeting.";
			exit;
		}
		
		$username = $_GET["username"];
			if ($username == ""){
			$username = "Guest";
		}			

		if (!file_exists($file = $space.".txt")){
			fopen($file, 'w');
		}
		$arr = file($file);
		$online_users = 0;
		$user_list = array();
		$user_is_listed = false;
		
		// Remove line if timeout exceeded
		for ($i = 0; $i < count($arr); $i++){
			if ($time - intval(substr($arr[$i], strpos($arr[$i], "	") + 4)) > $timeout){
				unset($arr[$i]);
				$arr = array_values($arr);
				file_put_contents($file, implode($arr));
			}
		}
		
		// Count users in file
		for ($i = 0; $i < count($arr); $i++){
			$some_user = substr($arr[$i], 0, strpos($arr[$i], "	"));
			array_push($user_list, $some_user);
			if ($some_user == $username){
				$user_is_listed = true;
				$line_of_user = $i;
			}
			$online_users++;
		}
		// Merely edit timestamp of user if already listed
		if ($user_is_listed){
			for ($i = 0; $i < count($arr); $i++){
				$arr[$line_of_user] = substr($arr[$line_of_user], 0, strlen($username))."	".$time."\n";
				$arr = array_values($arr);
				file_put_contents($file, implode($arr)); // 'Glue' array elements into string
			}
		}
		// Append user to file
		else {
			file_put_contents($file, $username."	".$time."\n", FILE_APPEND);
			array_push($user_list, $username); // So that user sees himself on list
			$online_users++;
		}

		echo "<b>Users online: ".$online_users."</b>";

		// Display online users and pics
		foreach ($user_list as $value){
			echo "<br><a style=text-decoration:none; href=http://wikispaces.com/user/view/".$value.">
				<img src=http://www.wikispaces.com/user/pic/1350501656/".$value."-sm.jpg>  ".$value."</a>";
		}
		echo "<br><br><a href=https://github.com/Fysac/wikispaces-counter><small>wikispaces-counter</small></a>";
		?>
	</body>
</html>
