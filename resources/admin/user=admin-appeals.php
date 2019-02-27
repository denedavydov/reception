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
						                echo '<td><form method="POST"><button type="submit" value="'.$id.'" class="btn btn-success" name="answer"><span class="glyphicon glyphicon-share-alt"></span> Направить ответ</button></form></td>';
						                $count++;
						            echo "\t</tr>\n";
						        }

						        if (isset($_POST['answer'])) {
						        	$id = $_POST['answer'];
						        	$query = "UPDATE `appeals` SET `status` = 'Получен ответ' WHERE `appeals`.`id` = '$id'";
						        	$result = mysql_query($query);

						        	$num_rows = mysql_num_rows($result);
									if ($num_rows != 0) {
										while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
								            foreach ($line as $col_value) {
								                $login = $col_value;
								                }
								            }
						        	}
						        }

						        mysql_free_result($result);
						        mysql_close($link);
								?>

						</table>
					</div>
				</div>
			</div>

	
		</div>
	</div>

</body>
</html>