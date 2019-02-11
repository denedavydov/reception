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
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				
				<?php
					include('templates/title_name.php');
				?>

				<form action="" method="POST">
					<label>Логин пользователя:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						  <input type="text" name="login" autocomplete="off" class="form-control" placeholder="Адрес электронной почты" aria-describedby="basic-addon1">
					</div><br/>
					<label>Пароль пользователя:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
						  <input type="password" name="password" maxlength="8" minlength="6" autocomplete="off" class="form-control" placeholder="Пароль пользователя" aria-describedby="basic-addon1">
					</div><br/>
					<button type="submit" class="btn btn-success btn-block" name="enter"><span class="glyphicon glyphicon-log-in"></span> Войти в систему</button>
				</form>

				<?php
				if(isset($_POST['enter'])){
				$login = htmlspecialchars($_POST['login']);
				$password = htmlspecialchars($_POST['password']);

				include('templates/config.php');

				$link = mysql_connect($db_path, $db_login, $db_password);
				mysql_select_db($db_name) or die("Не найдена БД");
				mysql_query('SET NAMES utf8');
				
				$query = "SELECT `login` FROM users WHERE `login` = '$login' and  `password` = '$password'";
				$result = mysql_query($query);

				$num_rows = mysql_num_rows($result);
				if ($num_rows != 0) {
					while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			            foreach ($line as $col_value) {
			                $login = $col_value;
			                }
			            }

			            $query = "SELECT `id` FROM users WHERE `login` = '$login' and  `password` = '$password'";
						$result = mysql_query($query);
						$num_rows = mysql_num_rows($result);

						if ($num_rows != 0) {
							while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			            		foreach ($line as $col_value) {
					                $id = $col_value;
					                }
			            		}}

			            $query = "SELECT `surname` FROM users WHERE `login` = '$login' and  `password` = '$password'";
						$result = mysql_query($query);
						$num_rows = mysql_num_rows($result);

						if ($num_rows != 0) {
							while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			            		foreach ($line as $col_value) {
					                $name = $col_value;
					                }
			            		}}

			            session_start();
	            		if ($_POST['login']=='admin@gmail.com') {
							$_SESSION['username'] = 'admin';
							$_SESSION['mail'] = 'admin@gmail.com'; // mail админа
					        $_SESSION['page'] = 'admin/user=admin';
					        header('location:resources/'.$_SESSION['page'].'.php');
						} else{
					        $_SESSION['username'] = $login;
					        $_SESSION['mail'] = 'admin@gmail.com'; // mail админа
					        $_SESSION['page'] = $id.'/'.'user=id_'.$id;
					        $_SESSION['name'] = $name;
					        $_SESSION['id'] = $id;
					        header('location:resources/'.$_SESSION['page'].'.php');
				        	}
				        exit();
					} else echo '<br/><p class="text-danger text-center">не верный логин или пароль!</p>';
					

				    mysql_free_result($result);
				    mysql_close($link);

				}
				?>

				<hr/>
				<p class="text-center"><a href="https://school416spb.ru" target="_blank">Школьный сайт</a></p>
				<p class="text-center"><a href="registration.php">Регистрация</a></p>
				<p class="text-center"><a href="fogot.php">Забыли пароль</a></p>
		
		        <?php include('templates/footer.php'); ?>		
		</div>	

	</div>
	</div>

</body>
</html>