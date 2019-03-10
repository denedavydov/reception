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
					<li role="presentation" class="active"><a href="<?php echo 'resources/'.$_SESSION['page'].'-appeals.php'; ?>"><span class="glyphicon glyphicon-file"></span> Обращения </a></li>
					<li role="presentation"><a href="<?php echo 'resources/'.$_SESSION['page'].'-appointments.php'; ?>"><span class="glyphicon glyphicon-pencil"></span> Записи на прием </a></li>
					<li role="presentation"><a href="#"><span class="glyphicon glyphicon-envelope"></span> Архив </a></li>
				</ul>
			</div>


			<!--Вывод таблицы "Обрабатываемые обращения"-->
			<div class="col-xs-12">
				<h2 class="text-primary"> Обрабатываемые обращения <?php 
								
								include('../../templates/config.php');

						       	$link = mysql_connect($db_path, $db_login, $db_password);
								mysql_select_db($db_name) or die("Не найдена БД");
								mysql_query('SET NAMES utf8');


						        $query = "SELECT * FROM `appeals` WHERE `status`='Находится на рассмотрении'";
						        $result = mysql_query($query);
						        echo mysql_num_rows($result);
						        
						        mysql_free_result($result);
						        mysql_close($link);
				?> </h2>

				<div  id="appeals_processed">
					<div class="table-responsive">
						<table class="table table-hover table-bordered text-center">
							<tr class="info">
								<td colspan="2"><strong>Дата</strong></td>
								<td><strong>Время</strong></td>
								<td><strong>От кого</strong></td>
								<td><strong>Тема</strong></td>
								<td><strong>Текст</strong></td>
								<td><strong>Статус</strong></td>
							</tr>

							<?php

						        include('../../templates/config.php');

						       $link = mysql_connect($db_path, $db_login, $db_password);
								mysql_select_db($db_name) or die("Не найдена БД");
								mysql_query('SET NAMES utf8');


						        $query = 'SELECT `date`, `year` , `time`, `mail`, `theme`, `message`, `id` FROM appeals WHERE `status`="Находится на рассмотрении" order by `id` desc';
						        $result = mysql_query($query);

						        $count=0;
						        $count_write_id=0;

						        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
						        echo "\t<tr>\n";
						                foreach ($line as $col_value) {
						                	if ($count_write_id != 6) {
						                		echo "\t\t<td>$col_value</td>\n";
						                	} else $id = $col_value;
						                    $count_write_id++;
						                }
						                $count_write_id = 0;
						                echo '<td><form action="" method="POST" name="val"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myForm" value="'.$id.'"id="old"><span class="glyphicon glyphicon-share-alt"></span> Направить ответ</button></form></td>';
						                $count++;
						            echo "\t</tr>\n";
						        }

						        if (isset($_POST['answer'])) { // Отправка ответа в таблицу
						        	$id = $_POST['answer'];

						        	$theme = htmlspecialchars($_POST['theme']);
	                				$message = htmlspecialchars($_POST['message']);
	                				$answer = $theme.' '.$message;

	                				$query = "UPDATE `appeals` SET `status` = 'Получен ответ', `answer` = '$answer' WHERE `appeals`.`id` = '$id'";
						        	$result = mysql_query($query);

						        	if(!mysql_query($query))
					                {echo '<p class="text-danger">ОШИБКА ОТПРАВКИ ОБРАЩЕНИЯ!</p>';} 
					                else 
					                	{

					                		$query = "SELECT `mail` FROM appeals WHERE `id` = '$id'";
											$result = mysql_query($query);

											$num_rows = mysql_num_rows($result);
											if ($num_rows != 0) {
												while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
										            foreach ($line as $col_value) {
										                $mail = $col_value;
										                }
										            }
										    }
						                	//отправка письма
									    
										    $mail_to = $mail; // Почта получателя

											$type = 'plain'; //Можно поменять на html; plain означяет: будет присылаться чистый текст.
											$charset = 'utf-8';

											include('../../templates/smtp_func.php');
											
											$message = $answer;
											$subject = 'Вам был направлен ответ из "Электронная Приёмная"';
											$mail_from = 'admin@gmail.com'; // mail школы
											$replyto = '"Электронная приемная"';
											$headers = "To: \"Пользователь\" <$mail_to>\r\n".
											              "From: \"$replyto\" <$mail_from>\r\n".
											              "Reply-To: $replyto\r\n".
											              "Content-Type: text/$type; charset=\"$charset\"\r\n";
											$sended = smtpmail($mail_to, $subject, $message, $headers);
										}

							    		echo '<p class="text-success">Обращение отправлено!</p>';
							    }
										        

						        mysql_free_result($result);
						        mysql_close($link);
							?>

							<script type="text/javascript"> // Передача value кнопки
									$('button#old').on('click',function(){
									var mysuperdata = $(this).val();
									$('button#new').val(mysuperdata);
									});
							</script>

						</table>
					</div>
				</div>
			</div>

			<div class="modal fade" id="myForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				    <div class="modal-content">

				    	<div class="modal-header">
					      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        <h3 class="modal-title" id="myModalLabel">Форма для направление ответа</h3>
				    	</div>

				    	<form action="" method="POST">
				    		<div class="modal-body">
								<label>Заголовок ответа: </label>
								<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
									  <input type="text" name="theme" required="" maxlength="200" autocomplete="off" class="form-control" placeholder="Заголовок" aria-describedby="basic-addon1">
								</div><br/>
								<label>Текст ответа: </label>
								<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-comment"></span></span>
									  <textarea name="message" required="" rows="10" autocomplete="off" class="form-control textarea" placeholder="Текст ответа..." aria-describedby="basic-addon1"></textarea>
								</div><br/>
				    		</div>

					    	<div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Отменить </button>
						        <button id="new" type="submit" class="btn btn-success" value="" name="answer"><span class="glyphicon glyphicon-share-alt"></span> Направить ответ </button>
						    </div>
				    	</form>

				    </div>
				</div>
			</div>

	
		</div>
	</div>

</body>
</html>