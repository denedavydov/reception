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
				<h2 class="text-primary">Записи</h2>
			</div>

			<div class="col-xs-12">
				<a onclick="$('#appeals').slideToggle('slow');" style="cursor: pointer; text-decoration: none;">
					<h2 class="text-primary">Поданные и обрабатываемые обращения<span class="
glyphicon glyphicon-chevron-down"></span></h2>
				</a>
				<div  id="appeals" style="display: none;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered text-center">
							<tr class="info">
								<td><strong>Дата</strong></td>
								<td><strong>Время</strong></td>
								<td><strong>Статус</strong></td>
								<td><strong>Тема</strong></td>
								<td><strong>Текст</strong></td>
							</tr>

							<?php

						        include('../../templates/config.php');

						       $link = mysql_connect($db_path, $db_login, $db_password);
								mysql_select_db($db_name) or die("Не найдена БД");
								mysql_query('SET NAMES utf8');


								/**WHERE `status`=""*/
						        $query = 'SELECT `date` , `time`, `status`, `theme`, `message` FROM appeals order by `id` desc';
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

			<div class="col-xs-12">
				<h2 class="text-primary">Документы ШРР</h2>
			</div>

			<!--подвал-->
			<div class="col-xs-12 text-center">
				<?php include('../../templates/footer.php'); ?>
			</div>

	
		</div>
	</div>

</body>
</html>