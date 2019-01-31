<?php
	include('../../templates/session_start.php');
?>
<?php
	include('../../templates/session_close.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<base href="/reception/" /><!--абсолютный путь-->
	<?php
		include('../../templates/head.php');
	?>
</head>
<body>

	<div class="container">
		<div class="row"> 
			
			<!--шапка страницы-->
			<?php
				include('../../templates/header.php');
			?>	

			<!--вывод меню-->
			<div class="col-xs-12">
				<?php
					include('../../templates/menu.php');
				?>
			</div>

			<?php
				if(isset($_POST['enter'])) {

						$user_id = $_SESSION['id'];
						$mail = $_SESSION['username'];
						$theme = htmlspecialchars($_POST['theme']);
						$message = htmlspecialchars($_POST['message']);
						$status = "Отправлено";

						// Отправка данных в БД

						include('../../templates/config.php');

						$link = mysql_connect($db_path, $db_login, $db_password);
						mysql_select_db($db_name) or die("Не найдена БД");
						mysql_query('SET NAMES utf8');

						$sql = 'INSERT INTO appeals (user_id, mail, theme, message, status) VALUES ("'.$user_id.'", "'.$mail.'", "'.$theme.'", "'.$message.'", "'.$status.'")';                              
	    
		                if(!mysql_query($sql))
		                {echo '<p class="text-danger">ОШИБКА ОТПРАВКИ ОБРАЩЕНИЯ!</p>';} 
		                else 
		                	{
			                	//отправка письма
						    
							    $mail_to = "barash2229@gmail.com"; // Почта получателя

								$type = 'plain'; //Можно поменять на html; plain означяет: будет присылаться чистый текст.
								$charset = 'utf-8';

								include('../../templates/smtp_func.php');
								
								$message = $_SESSION['username'].'   '.$_POST['message'];
								$subject = $_POST['theme'];
								$mail_from = $_SESSION['username'];
								$replyto = '"Электронная приемная"';
								$headers = "To: \"Пользователь\" <$mail_to>\r\n".
								              "From: \"$replyto\" <$mail_from>\r\n".
								              "Reply-To: $replyto\r\n".
								              "Content-Type: text/$type; charset=\"$charset\"\r\n";
								$sended = smtpmail($mail_to, $subject, $message, $headers);
							}
					}
			?>

			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-0" style="margin-top: 15px;">

						<!--Форма обращения-->
						<form action="" method="POST">
							<label>Тема обращения: </label>
							<div class="input-group">
								  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
								  <input type="text" name="theme" required="" maxlength="200" autocomplete="off" class="form-control" placeholder="Тема обращения" aria-describedby="basic-addon1">
							</div><br/>
							<label>Текст обращения: </label>
							<div class="input-group">
								  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-comment"></span></span>
								  <textarea name="message" required="" autocomplete="off" class="form-control" placeholder="Ваше обращение" aria-describedby="basic-addon1"></textarea>
							</div><br/>
							<button type="submit" class="btn btn-success" name="enter"><span class="glyphicon glyphicon-log-in"></span> Отправить </button>
						</form>

					</div>

					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-0">
								<h1 style="font-size: 20px;">Ваши предыдущие обращения: </h1>
							</div>
						</div>
					</div>

						<!--подвал-->
						<div class="col-xs-12 text-center">
							<?php include('../../templates/footer.php'); ?>
						</div>

				</div>
			</div>

	
		</div>
	</div>

</body>
</html>