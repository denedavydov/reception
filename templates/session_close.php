<?php
	if(isset($_POST['exit'])){
	unset($_SESSION['username']); /*завершение сессии*/
	session_destroy();
	header('location:../index.php');
	exit();
	}	
?>