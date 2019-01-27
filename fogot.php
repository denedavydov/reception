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

				<ol class="breadcrumb">
					  <li><a href="index.php">Главная</a></li>
					  <li class="active">Восстановление пароля</li>
				</ol>

				<p>Укажите адрес электронной почты и данные паспорта, указанные Вами при регистрации</p>

				<?php
					if (isset($_POST['fogot'])) {
               		
               		$login = htmlspecialchars($_POST['login']);
               		$passport = htmlspecialchars($_POST['passport']); 

               		include('templates/config.php');

					$link = mysql_connect($db_path, $db_login, $db_password);
					mysql_select_db($db_name) or die("Не найдена БД");
					mysql_query('SET NAMES utf8');

	                $query = "SELECT `password` FROM users WHERE `login` = '$login' AND `passport` = '$passport'";
					$result = mysql_query($query);

					$num_rows = mysql_num_rows($result);
					if ($num_rows != 0) {
						while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
				            foreach ($line as $col_value) {
				                $password = $col_value;
				                }
				            }

				            //отправка письма пользователю при регистрации
				    
						    $mail_to = $login;

							$type = 'plain'; //Можно поменять на html; plain означяет: будет присылаться чистый текст.
							$charset = 'utf-8';

							include('templates/smtp_func.php');
							
							$message = 'Ваш пароль для входа: '.$password.'. Вход в систему: https://reception.school416spb.ru';
							$subject = 'Восстановление доступа "Электронная приёмная"';
							$mail_from = 'support@school416spb.ru';
							$replyto = '"Электронная приемная"';
							$headers = "To: \"Пользователь\" <$mail_to>\r\n".
							              "From: \"$replyto\" <$mail_from>\r\n".
							              "Reply-To: $replyto\r\n".
							              "Content-Type: text/$type; charset=\"$charset\"\r\n";
							$sended = smtpmail($mail_to, $subject, $message, $headers);

		         			$output='<br/><p class="text-success">На указанный адрес электронной почты отпралено письмо!</p>';
					       

						} else $output='<br/><p class="text-danger">Пользователь не зарегистрирован в системе!</p>';
	                
	                mysql_free_result($result);
	                mysql_close($link);
		            }
				?>

				<form action="" method="POST">
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
						  <input type="email" name="login" required="" autocomplete="off" class="form-control" placeholder="адрес Вашей электронной почты" aria-describedby="basic-addon1">
					</div><br/>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-book"></span></span>
						  <input type="text" name="passport" required="" autocomplete="off" class="form-control" placeholder="серия и номер Вашего паспорта (10 цифр подряд без пробелов)" minlength="9" maxlength="10" aria-describedby="basic-addon1">
					</div><br/>
					<button type="submit" name="fogot" class="btn btn-danger"><span class="glyphicon glyphicon-eye-open"></span> восстановить пароль</button>
				</form>

				<?php
					echo $output;
				?>

				<hr/>
				<p class="text-center">Давыдов Д.Э. &copy; 2018<br/>Все права сохранены</p>

		</div>	

	</div>
	</div>

</body>
</html>