<?php
	include('templates/config.php');

    $link = mysql_connect($db_path, $db_login, $db_password);
	mysql_select_db($db_name) or die("Не найдена БД");
	mysql_query('SET NAMES utf8');

	$date = date("d.m.Y");
	$day = date("w", $date);
	
    $query = "SELECT `time_from`, `time_to` FROM timetable WHERE `day`='$day'";
    $result = mysql_query($query);

    $count=0;
    $value = '';

	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	        foreach ($line as $col_value) {
	            $value = $value.'-'.$col_value;
	        }
	        $count++;
	}

	if (mysql_num_rows($result) != 0) {
		$value = explode("-", $value);
		$time_from = $value[0];
		$time_to = $value[1];

		$status = 'Свободно';
		$day = date("d.m.Y");
		$date = date("d.m.Y", strtotime($day . " +7 days"));

		while ($time_from <= $time_to) {
			$sql = 'INSERT INTO appointments (day, time, status VALUES ("'.$day.'", "'.$time_from.'", "'.$status.'")';
			$time_from = $time_from + 0.3
			if ($time_from - floor($time_from) >=6) {
				$time_from++;
				$time_from = $time_from - 0.6;
			}
		}
	}

    mysql_free_result($result);
	mysql_close($link);
?>