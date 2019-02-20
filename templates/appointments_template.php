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
						<div class="input-group">
							  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-comment"></span></span>
							  <input type="text" name="name" required="" autocomplete="off" class="form-control" placeholder="Успеваемость ребенка" aria-describedby="basic-addon1">
						</div><br/>
					
				
					<div class="table-responsive">
						<table class="table table-hover table-bordered text-center">
							<tr class="info">
								<td><strong>Дата</strong></td>
								<td><strong>Время</strong></td>
								<td><strong>Произвести запись</strong></td>
							</tr>

							<?php
						        include('../../templates/config.php');

						       $link = mysql_connect($db_path, $db_login, $db_password);
								mysql_select_db($db_name) or die("Не найдена БД");
								mysql_query('SET NAMES utf8');


						        $query = 'SELECT `day`, `time`, `id` FROM appointments WHERE `status`="Свободно" order by `id` desc';
						        $result = mysql_query($query);

						        $count=0;
						        $count_write_id=0;

						        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
						        echo "\t<tr>\n";
						                foreach ($line as $col_value) {
						                	if ($count_write_id != 2) {
						                		echo "\t\t<td>$col_value</td>\n";
						                	} else $id = $col_value;
						                    $count_write_id++;
						                }
						                $count_write_id = 0;
						                echo '<td><button type="submit" value="'.$id.'" class="btn btn-success" name="status"><span class="glyphicon glyphicon-share-alt"></span> Записаться на прием </button></td>';
						                $count++;
						            echo "\t</tr>\n";
						        }

						        if (isset($_POST['status'])) {

						        	$id = $_POST['status'];
						        	$name = $_SESSION['name'];
						        	$mail = $_SESSION['username'];

						        	$query = "UPDATE `appointments` SET `status` = 'Занята', `name` = '$name', `mail` = '$mail' WHERE `appointments`.`id` = '$id'";
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