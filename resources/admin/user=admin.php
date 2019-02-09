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
					<li role="presentation" class="active"><a href="<?php $_SESSION['page'] = 'admin/user=admin'; echo 'resources/'.$_SESSION['page'].'.php' ?>" style="cursor: pointer;"><span class="glyphicon glyphicon-home"></span> <?php echo  $_SESSION['name']; ?> </a></li>
					<li role="presentation"><a href="#"><span class="glyphicon glyphicon-envelope"></span> Архив </a></li>
				</ul>
			</div>

			<div class="col-xs-12">
				<a onclick="$('#appeals').slideToggle('slow');" style="cursor: pointer; text-decoration: none;">
				<h2 class="text-primary">Полученные обращения <?php 
								
								include('../../templates/config.php');

						       $link = mysql_connect($db_path, $db_login, $db_password);
								mysql_select_db($db_name) or die("Не найдена БД");
								mysql_query('SET NAMES utf8');


						        $query = "SELECT * FROM `appeals` WHERE `status`='Отправлено'";
						        $result = mysql_query($query);
						        echo mysql_num_rows($result);

						        mysql_free_result($result);
						        mysql_close($link);
				?> <span class="glyphicon glyphicon-chevron-down"></span></h2>
				</a>

				<div  id="appeals" style="display: none;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered text-center">
							<tr class="info">
								<td><strong>Дата</strong></td>
								<td><strong>Время</strong></td>
								<td><strong>Тема</strong></td>
								<td><strong>Текст</strong></td>
								<td><strong>Статус</strong></td>
							</tr>

							<?php

						        include('../../templates/config.php');

						       $link = mysql_connect($db_path, $db_login, $db_password);
								mysql_select_db($db_name) or die("Не найдена БД");
								mysql_query('SET NAMES utf8');


						        $query = 'SELECT `date` , `time`, `theme`, `message` FROM appeals WHERE `status`="Отпралено" or `status`="Отправлено" order by `id` desc';
						        $result = mysql_query($query);

						        $count=0;

						        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
						        echo "\t<tr>\n";
						                foreach ($line as $col_value) {
						                    echo "\t\t<td>$col_value</td>\n";
						                }
						                echo '<td><button type="submit" class="btn btn-info" name="status"><span class="glyphicon glyphicon-share-alt"></span> Принять к рассмотрению</button></td>';
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

			<div class="col-xs-12">
				<a onclick="$('#appeals').slideToggle('slow');" style="cursor: pointer; text-decoration: none;">
				<h2 class="text-primary">Обрабатываемые обращения <?php 
								
								include('../../templates/config.php');

						       $link = mysql_connect($db_path, $db_login, $db_password);
								mysql_select_db($db_name) or die("Не найдена БД");
								mysql_query('SET NAMES utf8');


						        $query = "SELECT * FROM `appeals` WHERE `status`='Находится на рассмотрении'";
						        $result = mysql_query($query);
						        echo mysql_num_rows($result);
						        
						        mysql_free_result($result);
						        mysql_close($link);
				?> <span class="glyphicon glyphicon-chevron-down"></span></h2>
				</a>

				<div  id="appeals" style="display: none;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered text-center">
							<tr class="info">
								<td><strong>Дата</strong></td>
								<td><strong>Время</strong></td>
								<td><strong>Тема</strong></td>
								<td><strong>Текст</strong></td>
								<td><strong>Статус</strong></td>
							</tr>

							<?php

						        include('../../templates/config.php');

						       $link = mysql_connect($db_path, $db_login, $db_password);
								mysql_select_db($db_name) or die("Не найдена БД");
								mysql_query('SET NAMES utf8');


						        $query = 'SELECT `date` , `time`, `theme`, `message` FROM appeals WHERE `status`="Отпралено" or `status`="Находится на рассмотрении" order by `id` desc';
						        $result = mysql_query($query);

						        $count=0;

						        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
						        echo "\t<tr>\n";
						                foreach ($line as $col_value) {
						                    echo "\t\t<td>$col_value</td>\n";
						                }
						                echo '<td><button type="submit" class="btn btn-success" name="status"><span class="glyphicon glyphicon-share-alt"></span> Направить ответ</button></td>';
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

</body>
</html>