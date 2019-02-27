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
									<td><strong>отменить запись</strong></td>
								</tr>

								<?php
							        include('../../templates/config.php');

							       $link = mysql_connect($db_path, $db_login, $db_password);
									mysql_select_db($db_name) or die("Не найдена БД");
									mysql_query('SET NAMES utf8');


							        $query = 'SELECT `day`, `time`, `name`, `theme`, `id` FROM appointments WHERE `status`="Занята" order by `id` desc';
							        $result = mysql_query($query);

							        $count_write_button=0;
							        $count = 0;

							        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
							        	echo "\t<tr>\n";
						                foreach ($line as $col_value) {
						                	if ($count == 0) {
						                		$date = date("d.m.Y");
						                		if (strtotime($col_value) > strtotime($date)){
						                			echo "\t\t<td>$col_value</td>\n";
						                    		$count = 1;
						                		}
						                	} else if ($count == 1) {$count = 2;}
						                	if ($count == 2) {
							                	if ($count_write_button != 3) {
							                		echo "\t\t<td>$col_value</td>\n";
							                	} else {
							                		$id = $col_value;
							                		 echo '<td><form method="POST"><button type="submit" value="'.$id.'" class="btn btn-danger" name="status_appointments"><span class="glyphicon glyphicon-remove"></span> Отменить запись </button></form></td>';
							                	}
							                $count_write_button++;
						                	}
						                }
						                $count = 0;
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

			<!--подвал-->
			<div class="col-xs-12 text-center">
				<?php include('../../templates/footer.php'); ?>
			</div>

	
		</div>
	</div>

</body>
</html>