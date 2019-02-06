<?php
	session_start();

	if (!isset($_SESSION['username'])){
			header('location:../../index.php');
			exit();
		}else { 

			$login=$_SESSION['username'];
			$page=$_SESSION['page'];


			/*определить страницу в строке*/
			$page_name = 'admin/'.basename($_SERVER['PHP_SELF'], ".php");
			$page_name = explode("-", $page_name);

			if ($page != $page_name[0]) {
				unset($_SESSION['username']);
				unset($_SESSION['page']);
				session_destroy();
				header('location:../../index.php');
				exit();
			}


			mysql_free_result($result);
			mysql_close($link);

		} 
?>