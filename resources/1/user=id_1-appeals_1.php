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
						$date=date("d.m");
						$year=date("Y");
						$time=date("h:i");


						// Отправка данных в БД

						include('../../templates/config.php');

						$link = mysql_connect($db_path, $db_login, $db_password);
						mysql_select_db($db_name) or die("Не найдена БД");
						mysql_query('SET NAMES utf8');

						$sql = 'INSERT INTO appeals (user_id, mail, theme, message, status, date, year, time) VALUES ("'.$user_id.'", "'.$mail.'", "'.$theme.'", "'.$message.'", "'.$status.'", "'.$date.'", "'.$year.'", "'.$time.'")';                              
	    
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

							mysql_free_result($result);
				    		mysql_close($link);
					}
			?>

					<div class="col-xs-12 col-sm-12 col-md-6" style="margin-top: 15px;">

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
								  <textarea name="message" required="" rows="10" autocomplete="off" class="form-control textarea" placeholder="Ваше обращение" aria-describedby="basic-addon1"></textarea>
							</div><br/>
							<button type="submit" class="btn btn-success" name="enter"><span class="glyphicon glyphicon-log-in"></span> Отправить </button>
						</form>

					</div>


							<div class="col-xs-12">
								<a onclick="$('#appeals').slideToggle('slow');" style="cursor: pointer; text-decoration: none;">
									<h3 class="text-primary">Ваши предыдущие обращения <span class="
glyphicon glyphicon-chevron-down"></span></h3>
								</a>
								<p class="text-success"><span class="
glyphicon glyphicon-info-sign"></span> Обработанные обращения</p>
								<div  id="appeals" style="display: none;">
									<div class="table-responsive">
										<table class="table table-hover table-bordered text-center">
											<tr class="info">
												<td><strong>Дата</strong></td>
												<td><strong>Время</strong></td>
												<td><strong>Тема</strong></td>
												<td><strong>Текст</strong></td>
											</tr>

											<?php

									            include('../../templates/config.php');

							                   $link = mysql_connect($db_path, $db_login, $db_password);
												mysql_select_db($db_name) or die("Не найдена БД");
												mysql_query('SET NAMES utf8');


							                    $query = 'SELECT `date` , `time`, `theme`, `message` FROM appeals WHERE `status`="Получен ответ" order by `id` desc';
							                    $result = mysql_query($query);

						                        $count=0;

							                    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
							                    echo "\t<tr>\n";
							                            foreach ($line as $col_value) {
							                                echo "\t\t<td>$col_value</td>\n";
							                            }
						                                $count++;
							                        echo "\t</tr>\n";
							                    }

							                    mysql_free_result($result);
							                    mysql_close($link);
						           			?>

										</table>
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