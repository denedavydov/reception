<?php
	session_start();

	if (!isset($_SESSION['username'])){
			header('location:../../index.php');
			exit();
		}else{ 

			$login=$_SESSION['username'];
			$page=$_SESSION['page'];
			include('../../templates/config.php');

			$link = mysql_connect($db_path, $db_login, $db_password);
			mysql_select_db($db_name) or die("Не найдена БД");
			mysql_query('SET NAMES utf8');
						
			$query = "SELECT `login` FROM users WHERE `login` = '$login'";
			$result = mysql_query($query);

			$num_rows = mysql_num_rows($result);
						
			if ($num_rows != 0) {
				while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
					foreach ($line as $col_value) {
					            $db_login = $col_value;
					    }
				}
			}

			//поиск id каталога пользователя
			$query = "SELECT `id` FROM users WHERE `login` = '$login'";
			$result = mysql_query($query);
			$num_rows = mysql_num_rows($result);

			if ($num_rows != 0) {
				while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
            		foreach ($line as $col_value) {
		                $id = $col_value;
		                }
            		}}

			/*определить страницу в строке*/
			$page_name = $id.'/'.basename($_SERVER['PHP_SELF'], ".php");

			if ($page != $page_name) {
				unset($_SESSION['username']);
				unset($_SESSION['page']);
				session_destroy();
				header('location:../../index.php');
				exit();
			}

			/*не совпадение логина введенного и в БД*/
			if ($login != $db_login) {
				header('location:../../index.php');
				exit();
			}

			mysql_free_result($result);
			mysql_close($link);

		}
?>