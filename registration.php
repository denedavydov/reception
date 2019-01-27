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

				<ol class="breadcrumb">
					  <li><a href="index.php">Главная</a></li>
					  <li class="active">Регистрация пользователя</li>
				</ol>

				<?php
            	if (isset($_POST['register'])) {
               		
               		$name = htmlspecialchars($_POST['name']); 
	                $surname = htmlspecialchars($_POST['surname']);
	                $login = htmlspecialchars($_POST['login']);
	                $passport = htmlspecialchars($_POST['passport']);
	                $status = htmlspecialchars($_POST['status']);
	                $password = htmlspecialchars($_POST['password']);

               		include('templates/config.php');

					$link = mysql_connect($db_path, $db_login, $db_password);
					mysql_select_db($db_name) or die("Не найдена БД");
					mysql_query('SET NAMES utf8');

					$query = "SELECT `login` FROM users WHERE `login` = '$login'";
					$result = mysql_query($query);

					$num_rows = mysql_num_rows($result);
					if ($num_rows != 0) {
						while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
				            foreach ($line as $col_value) {
				                $people = $col_value;
				                }
				            }
				         }

				    if($people==$login){
				    	echo '<p class="text-danger">По такому адресу электронной почты уже зарегистрирован пользователь!</p>';
				    }else{

	                $sql = 'INSERT INTO users (name, surname, login, passport, status, password) VALUES ("'.$name.'", "'.$surname.'", "'.$login.'", "'.$passport.'", "'.$status.'", "'.$password.'")';                              
	    
	                if(!mysql_query($sql))
	                {echo '<p class="text-danger">ОШИБКА РЕГИСТРАЦИИ!</p>';} 
	                else 
	                {

	                	//отправка письма пользователю при регистрации
				    
					    $mail_to = $login;

						$type = 'plain'; //Можно поменять на html; plain означяет: будет присылаться чистый текст.
						$charset = 'utf-8';

						include('templates/smtp_func.php');
						
						$message = $surname.', Вы успешно зарегистрировались в "Электронная Приёмная" ГБОУ средней общеобразовательной школы № 416 Петродворцового района Санкт-Петербурга. Ваш логин для входа: '.$login.', Ваш пароль: '.$password.'. Вход в систему: https://reception.school416spb.ru';
						$subject = 'Регистрация "Электронная приёмная"';
						$mail_from = 'support@school416spb.ru';
						$replyto = '"Электронная приемная"';
						$headers = "To: \"Пользователь\" <$mail_to>\r\n".
						              "From: \"$replyto\" <$mail_from>\r\n".
						              "Reply-To: $replyto\r\n".
						              "Content-Type: text/$type; charset=\"$charset\"\r\n";
						$sended = smtpmail($mail_to, $subject, $message, $headers);

						//создание страницы пользователя
						$query = "SELECT `id` FROM users WHERE `login` = '$login'";
						$result = mysql_query($query);
						$num_rows = mysql_num_rows($result);

						if ($num_rows != 0) {
							while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			            		foreach ($line as $col_value) {
					                $id = $col_value;
					                }
			            		}}
						            
						$file='templates/user_template.php';
						$newfile='resources/user=id_'.$id.'.php';
						copy($file, $newfile);

	                	session_start();
	                	$_SESSION['reg'] = TRUE;
	                	header('location:regresult.php');
	                	exit();
	                }
	            }
	                
	                mysql_free_result($result);
	                mysql_close($link);
		            }
		        ?>

				<form action="" method="POST">
					<label>Фамилия:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						  <input type="text" name="name" required="" autocomplete="off" class="form-control" placeholder="Ваша фамилия" aria-describedby="basic-addon1">
					</div><br/>
					<label>Имя Отчество:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						  <input type="text" name="surname" required="" autocomplete="off" class="form-control" placeholder="Ваше имя и отчество" aria-describedby="basic-addon1">
					</div><br/>
					<label>Адрес электронной почты:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
						  <input type="email" name="login" required="" autocomplete="off" class="form-control" placeholder="используется как логин для входа" aria-describedby="basic-addon1">
					</div><br/>
					<label>Серия и номер паспорта:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-book"></span></span>
						  <input type="text" name="passport" autocomplete="off" minlength="9" maxlength="10" required="" class="form-control" placeholder="серия и номер Вашего паспорта (10 цифр подряд без пробелов)" aria-describedby="basic-addon1">
					</div><br/>
					<label>Роль:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-cog"></span></span>
						  <select class="form-control" name="status" required="">
						  	<option></option>
						  	<option>Родитель обучающегося</option>
						  	<option>Законный представитель обучающегося</option>
						  </select>
					</div><br/>
					<label>Пароль пользователя:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
						  <input type="password" name="password" required="" minlength="6" maxlength="8" autocomplete="off" class="form-control" placeholder="от 6 до 8 символов" aria-describedby="basic-addon1">
					</div><br/>
					<div class="checkbox">
			          <label>
			            <input type="checkbox" required="" /> <a href="" target="_blank" title="Посмотреть">Даю согласие на обработку своих персональных данных</a>
			          </label>
			        </div>
			        <div class="checkbox">
			          <label>
			            <input type="checkbox" required="" /> <a href="" target="_blank" title="Посмотреть">Ознакомлен с правилами работы</a>
			          </label>
			        </div>
					<button type="submit" class="btn btn-success" name="register"><span class="glyphicon glyphicon-log-in"></span> регистрация в системе</button>
				</form>

				<?php include('templates/footer.php'); ?>
		</div>	

	</div>
	</div>

</body>
</html>