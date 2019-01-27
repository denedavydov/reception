<?php
	session_start();
	if ($_SESSION['reg'] != TRUE) {
		header('location:index.php');
	    exit();
	}	                	
?>
<?php
	if (isset($_POST['enter'])) {
			unset($_SESSION['reg']);
			session_destroy();
			header('location:index.php');
			exit();
		}	                	
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<base href="/reception/" /><!--абсолютный путь-->
	<?php
		include('templates/head.php');
	?>
</head>
<body>

	<div class="container">
		<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2">
				
				<?php
					include('templates/title_name.php');
				?>

				<p class="text-center text-success">
					Поздравляем! Вы успешно зарегистрировались в системе!
				</p>
				<p class="text-center text-warning">
					На указанный Вами при регистрации адрес электронной почты были высланы регистрационные данные!
				</p>
				<p class="text-center">
					Теперь Вы можете <form class="text-center" action="" method="POST"><button type="submit" name="enter" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> войти в систему</button></form>
				</p>

		</div>	

	</div>
	</div>

</body>
</html>