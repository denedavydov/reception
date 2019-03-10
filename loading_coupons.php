<?php
	// Выполнять каждый день после 17:00

	include('templates/config.php');

    $link = mysql_connect($db_path, $db_login, $db_password);
	mysql_select_db($db_name) or die("Не найдена БД");
	mysql_query('SET NAMES utf8');

	$date = date("d.m.Y");
	$day = date("d.m.Y", strtotime($date . " +7 days"));

	$query = "SELECT `day` FROM canseled WHERE `day`='$day'  order by `id` asc";
	$result = mysql_query($query);
	
	if (mysql_num_rows($result) == 0) { // Проверка отмены записи на этот день

		$day = date("w", $date);
		
	    $query = "SELECT `time_from`, `time_to` FROM timetable WHERE `day`='$day'  order by `id` asc";
	    $result = mysql_query($query);

	    if (mysql_num_rows($result) != 0) {  // Если есть прием в этот день

		    $count=0;
		    $count_time = 0;

			while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		        foreach ($line as $col_value) {
		            if ($count_time == 0) {
		            	$time_from = $col_value;
		            } else $time_to = $col_value;
		            $count_time = 1;
		        }
		        $count++;
			}

			//$time_from = str_replace(".", ":", $time_from);
			//$time_to =str_replace(".", ":", $time_to);

			$status = 'Свободно';
			//$date = date("d.m.Y");
			$day = date("d.m.Y", strtotime($date . " +7 days"));
			$empty = '';

			while ($time_from <= $time_to - 0.3) {

				$time_from_new = str_replace(".", ":", $time_from);

				$sql = 'INSERT INTO appointments (day, time, status, name, mail, theme) VALUES ("'.$day.'", "'.$time_from_new.'", "'.$status.'", "'.$empty.'", "'.$empty.'", "'.$empty.'")';
				if(!mysql_query($sql)){ 
					echo '<p class="text-danger">ОШИБКА!</p>';
				}
				$time_from = $time_from + 0.3;
				if ($time_from - floor($time_from) >= 0.6) {
					$time_from++;
					$time_from = $time_from - 0.6;
				}
			}
		}
	}

    mysql_free_result($result);
	mysql_close($link);
?>