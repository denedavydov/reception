<?php
	include('../../templates/session_start_admin.php');
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
				<ul class="nav nav-tabs">
				  <hr class="hidden-sm hidden-md hidden-lg"/>
					<li role="presentation"><a href="<?php $_SESSION['page'] = 'admin/user=admin'; echo 'resources/'.$_SESSION['page'].'.php' ?>" style="cursor: pointer;"><span class="glyphicon glyphicon-home"></span> <?php echo  $_SESSION['name']; ?> </a></li>
					<li role="presentation"><a href="<?php echo 'resources/'.$_SESSION['page'].'-appeals.php'; ?>"><span class="glyphicon glyphicon-file"></span> Обращения </a></li>
					<li role="presentation" class="active"><a href="<?php echo 'resources/'.$_SESSION['page'].'-appointments.php'; ?>"><span class="glyphicon glyphicon-pencil"></span> Записи на прием </a></li>
					<li role="presentation"><a href="#"><span class="glyphicon glyphicon-envelope"></span> Архив </a></li>
				</ul>
			</div>

			<!--Вывод таблици записи на прием-->
			<div class="col-xs-12">
					<h2 class="text-primary">Записи</h2>
					
						<div class="table-responsive">
							<table class="table table-hover table-bordered text-center">
								<tr class="info">
									<td><strong>Дата</strong></td>
									<td><strong>Время</strong></td>
									<td><strong>Имя</strong></td>
									<td><strong>Тема</strong></td>
									<td><strong>Отменить запись</strong></td>
								</tr>

								<?php
							        include('../../templates/config.php');

							        $link = mysql_connect($db_path, $db_login, $db_password);
									mysql_select_db($db_name) or die("Не найдена БД");
									mysql_query('SET NAMES utf8');


							        $query = 'SELECT `day`, `time`, `name`, `theme`, `id` FROM appointments WHERE `status`="Занята" order by `id` asc';
							        $result = mysql_query($query);

							        $count_write_button=0;
							        $count_date = 0;
							        $count = 0;

							        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
							        	echo "\t<tr>\n";
						                foreach ($line as $col_value) {
						                	if ($count == 0) {
						                		if ($count_date != 0) {
								                	if ($count_write_button != 3) {
									                		echo "\t\t<td>$col_value</td>\n";
									                	} else {
									                		$id = $col_value;
									                		 echo '<td><form method="POST"><button type="submit" value="'.$id.'" class="btn btn-danger" name="status_appointments"><span class="glyphicon glyphicon-remove"></span> Отменить запись </button></form></td>';
									                	}
									                $count_write_button++;
							                	} else {
							                		$date = date("d.m.Y");
							                		if (strtotime($col_value) > strtotime($date)){
							                			echo "\t\t<td>$col_value</td>\n";
							                    		$count_date = 1;
							                		} else $count++;
							                	}
						                	}
						                }
						                $count = 0;
						                $count_date = 0;
						                $count_write_button = 0;
							            echo "\t</tr>\n";
							        }

							        if (isset($_POST['status_appointments'])) {

							        	$id = $_POST['status_appointments'];
							        	$name = $_SESSION['name'];
							        	$mail = $_SESSION['username'];
							        	$theme = $_POST['theme'];

							        	$query = "UPDATE `appointments` SET `status` = 'Отменена' WHERE `appointments`.`id` = '$id'";

							        	if(!mysql_query($query))
						                {echo '<p class="text-danger">ОШИБКА!</p>';} 
						                else 
						                	{
							                	//отправка письма
										    
											    $mail_to = $_SESSION['username']; // Почта получателя

												$type = 'plain'; //Можно поменять на html; plain означяет: будет присылаться чистый текст.
												$charset = 'utf-8';

												include('../../templates/smtp_func.php');
												
												$message = 'По техническим причинам ваша запись была отменена. Приносим свои извинения.';

												$subject = 'Запись на прием отменена';
												$mail_from = $_SESSION['username'];
												$replyto = '"Электронная приемная"';
												$headers = "To: \"Пользователь\" <$mail_to>\r\n".
												              "From: \"$replyto\" <$mail_from>\r\n".
												              "Reply-To: $replyto\r\n".
												              "Content-Type: text/$type; charset=\"$charset\"\r\n";
												$sended = smtpmail($mail_to, $subject, $message, $headers);
											}
							        }

							        mysql_free_result($result);
							        mysql_close($link);
								?>

							</table>
						</div>
			</div>

			<div class="col-xs-12">
				<hr/>
				<form action="" method="POST">
					<h2 class="text-primary">Отмена записи на определенную дату</h2>
					<label>Дата:</label>
					<div class="input-group col-xs-12 col-sm-8 col-md-6">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
						  <input type="text" name="day" autocomplete="off" minlength="10" maxlength="10" required="" class="form-control" placeholder="Например: 20.12.2001" aria-describedby="basic-addon1">
					</div><br/>
						<button type="submit" class="btn btn-danger" name="canceled"><span class="glyphicon glyphicon-remove"></span> Отменить записи на эту дату </button><hr/>

					<?php
					// Отмене записи на указаный день

						if (isset($_POST['canceled'])) {
							
							include('../../templates/config.php');

					        $link = mysql_connect($db_path, $db_login, $db_password);
							mysql_select_db($db_name) or die("Не найдена БД");
							mysql_query('SET NAMES utf8');

							$day = htmlspecialchars($_POST['day']);

							$sql = 'INSERT INTO canceled (day) VALUES ("'.$day.'")';
							if(!mysql_query($sql)) {
								echo '<p class="text-danger">ОШИБКА!</p>';
							} else echo '<div class="col-xs-12"><p class="text-success">Запись успешно отменена!</p></div>'; // Исправить вывод

							mysql_free_result($result);
							mysql_close($link);
						}
					?>
				</form>
			</div>

			<!--Вывод таблицы "Отмененные записи"-->
			<div class="col-xs-12">
				<a onclick="$('#canseled_table').slideToggle('slow');" style="cursor: pointer; text-decoration: none;">
				<h2 class="text-primary"> Отмененные записи <span class="glyphicon glyphicon-chevron-down"></span></h2>
				</a>

				<div  id="canseled_table" style="display: none;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered text-center">
							<tr class="info">
								<td><strong>Дата</strong></td>
								<td><strong>Статус</strong></td>
							</tr>

							<?php

						        include('../../templates/config.php');

						       $link = mysql_connect($db_path, $db_login, $db_password);
								mysql_select_db($db_name) or die("Не найдена БД");
								mysql_query('SET NAMES utf8');


						        $query = 'SELECT `day`, `id` FROM canceled';
						        $result = mysql_query($query);

						        $count_write_button=0;
						        $count_date = 0;
						        $count = 0;

						        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
						        	echo "\t<tr>\n";
					                foreach ($line as $col_value) {
					                	if ($count == 0) {
					                		if ($count_date != 0) {
							                	if ($count_write_button != 0) {
								                		echo "\t\t<td>$col_value</td>\n";
								                	} else {
								                		$id = $col_value;
								                		 echo '<td><form method="POST"><button type="submit" value="'.$id.'" class="btn btn-success" name="new_status"><span class="glyphicon glyphicon-ok"></span> Возобновить запись </button></form></td>';
								                	}
								                $count_write_button++;
						                	} else {
						                		$date = date("d.m.Y");
						                		if (strtotime($col_value) >= strtotime($date)){
						                			echo "\t\t<td>$col_value</td>\n";
						                    		$count_date = 1;
						                		} else $count++;
						                	}
					                	}
					                }

					                $count = 0;
					                $count_date = 0;
					                $count_write_button = 0;
						            echo "\t</tr>\n";
							        }

							        if (isset($_POST['new_status'])) {

							        	$id = $_POST['new_status'];
							        	$query = "DELETE FROM `canceled` WHERE `canceled`.`id` = '$id'";
							        	$result = mysql_query($query);
							        }

							        mysql_free_result($result);
							        mysql_close($link);
								?>

						</table>
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-md-6">

				<?php
					if (isset($_POST['clear'])) { //очистка таблицы с расписанием

						include('../../templates/config.php');

				       $link = mysql_connect($db_path, $db_login, $db_password);
						mysql_select_db($db_name) or die("Не найдена БД");
						mysql_query('SET NAMES utf8');


				        $query = 'TRUNCATE TABLE timetable';
				        $result = mysql_query($query);
					}

					if (isset($_POST['add_timetable'])) { // Добавление новых дней в таблицу с расписанием

						$day = htmlspecialchars($_POST['day']);

						switch ($day) {
							case 'Понедельник':
								$day = 0;
								break;
							case 'Вторник':
								$day = 1;
								break;
							case 'Среда':
								$day = 2;
								break;
							case 'Четверг':
								$day = 3;
								break;
							case 'Пятница':
								$day = 4;
								break;
							case 'Суббота':
								$day = 5;
								break;
						}

	                	$time_from = htmlspecialchars($_POST['time_from']);
	                	$time_to = htmlspecialchars($_POST['time_to']);

	                	include('../../templates/config.php');

				       $link = mysql_connect($db_path, $db_login, $db_password);
						mysql_select_db($db_name) or die("Не найдена БД");
						mysql_query('SET NAMES utf8');


				        $query = 'INSERT INTO timetable (day, time_from, time_to) VALUES ("'.$day.'", "'.$time_from.'", "'.$time_to.'")';
				        $result = mysql_query($query);
	                }
				?>

				<hr/>
				<h2 class="text-primary"> Изменить график приема </h2><br/>
				<h4 class="text-primary">Добавить новый приемный день</h4><br/>
				<form action="" method="POST">
					<label>День недели:</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
						<select class="form-control" name="day" required="">
						  	<option></option>
						  	<option>Понедельник</option>
						  	<option>Вторник</option>
						  	<option>Среда</option>
						  	<option>Четверг</option>
						  	<option>Пятница</option>
						  	<option>Суббота</option>
						</select>
					</div><br/>
					<label>Время начала:</label>
					<div class="input-group col-xs-6 col-md-5">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-time"></span></span>
						  <input type="text" name="time_from" autocomplete="off" minlength="5" maxlength="5" required="" class="form-control" placeholder="13.30" aria-describedby="basic-addon1">
					</div><br/>
					<label>Время окончания:</label>
					<div class="input-group col-xs-6 col-md-5">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-time"></span></span>
						  <input type="text" name="time_to" autocomplete="off" minlength="5" maxlength="5" required="" class="form-control" placeholder="17.00" aria-describedby="basic-addon1">
					</div><br/>
					<button type="submit" class="btn btn-success" name="add_timetable"><span class="glyphicon glyphicon-ok"></span> Добавить приемный день</button><br/><br/>
				</form>
				<form action="" method="POST">
					<button type="submit" class="btn btn-danger" name="clear"><span class="glyphicon glyphicon-remove"></span> Удалить все приемные дни</button>
				</form>

			</div>
			<!--подвал-->
			<div class="col-xs-12 text-center">
				<?php include('../../templates/footer.php'); ?>
			</div>

	
		</div>
	</div>

</body>
</html>