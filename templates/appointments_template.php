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

			<div class="col-xs-12">
					<h2 class="text-primary">Свободные записи</h2>

					<form action="" method="POST">
						<label>Тема обращения:</label>
						<div class="input-group col-xs-12 col-sm-12 col-md-6">
							  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-comment"></span></span>
							  <input type="text" name="theme" required="" autocomplete="off" class="form-control" placeholder="Успеваемость ребенка" aria-describedby="basic-addon1">
						</div><br/>
					
						<!--Вывод таблици записи на прием-->
						<div class="table-responsive">
							<table class="table table-hover table-bordered text-center">
								<tr class="info">
									<td><strong>Дата</strong></td>
									<td><strong>Время (ч)</strong></td>
									<td><strong>Произвести запись</strong></td>
								</tr>

								<?php
							        include('../../templates/config.php');

							       $link = mysql_connect($db_path, $db_login, $db_password);
									mysql_select_db($db_name) or die("Не найдена БД");
									mysql_query('SET NAMES utf8');


							        $query = 'SELECT `day`, `time`, `id` FROM appointments WHERE `status`="Свободно" order by `id` desc';
							        $result = mysql_query($query);

							        $count_write_button=0;
							        $count = 0;

							        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
							        	echo "\t<tr>\n";
						                foreach ($line as $col_value) {
						                	if ($count == 0) {
						                		$date = date("d.m.Y");
						                		if (strtotime($col_value)>=strtotime($date)){
						                			echo "\t\t<td>$col_value</td>\n";
						                    		$count = 1;
						                		}
						                	} else if ($count == 1) {$count = 2;}
						                	if ($count == 2) {
							                	if ($count_write_button != 1) {
							                		echo "\t\t<td>$col_value</td>\n";
							                	} else {
							                		$id = $col_value;
							                		 echo '<td><button type="submit" value="'.$id.'" class="btn btn-success" name="status"><span class="glyphicon glyphicon-share-alt"></span> Записаться на прием </button></td>';
							                	}
							                $count_write_button++;
						                	}
						                }
						                $count = 0;
						                $count_write_button = 0;
							            echo "\t</tr>\n";
							        }

							        if (isset($_POST['status'])) {

							        	$id = $_POST['status'];
							        	$name = $_SESSION['name'];
							        	$mail = $_SESSION['username'];
							        	$theme = $_POST['theme'];

							        	$query = "UPDATE `appointments` SET `status` = 'Занята', `name` = '$name', `mail` = '$mail', `theme` = '$theme' WHERE `appointments`.`id` = '$id'";
							        	
							        	if(!mysql_query($query))
						                {echo '<p class="text-danger">ОШИБКА ЗАПИСИ НА ПРИЕМ!</p>';} 
						                else 
						                	{
							                	//отправка письма
										    
											    $mail_to = $_SESSION['username']; // Почта получателя

												$type = 'plain'; //Можно поменять на html; plain означяет: будет присылаться чистый текст.
												$charset = 'utf-8';

												include('../../templates/smtp_func.php');
												
												$message = $_SESSION['name'].', Вы успешно записались на прием';

												$query = "SELECT `day`, `time`, `theme` FROM appointments WHERE `id`='$id'";
												$result = mysql_query($query);
												$num_rows = mysql_num_rows($result);

												// Сбор сообщения
												if ($num_rows != 0) {
													while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
									            		foreach ($line as $col_value) {
											                $message = $message.' '.$col_value;
											            }
									            	}
									            }
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

							        mysql_free_result($result);
							        mysql_close($link);
								?>

							</table>
						</div>
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