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

			<form action="" method="POST">
				<label>Тема обращения: </label>
				<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-cog"></span></span>
					  <select class="form-control" name="theme" required="">
					  	<option></option>
					  	<option>Пункт_1</option>
					  	<option>Пункт_2</option>
					  	<option>Пункт_3</option>
					  	<option>Пункт_4</option>
					  </select>
				</div><br/>
				<label>Текст обращения: </label>
				<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
					  <textarea name="mail" required="" autocomplete="off" class="form-control" placeholder="Ваше обращение" aria-describedby="basic-addon1"></textarea>
				</div><br/>
				<button type="submit" class="btn btn-success" name="enter"><span class="glyphicon glyphicon-comment"></span> Отправить </button>
			</form>

			<!--подвал-->
			<div class="col-xs-12 text-center">
				<?php include('../../templates/footer.php'); ?>
			</div>

	
		</div>
	</div>

</body>
</html>