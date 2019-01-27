<?php
	include('../templates/session_start.php');
?>
<?php
	include('../templates/session_close.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<base href="/reception/" /><!--абсолютный путь-->
	<?php
		include('../templates/head.php');
	?>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-1 col-xs-12 col-sm-6">
				<p class="text-center">
					<img src="img/logo.jpg" alt="логотип" width="100" />
				</p>
			</div>

			<div class="col-md-5 col-xs-12 col-sm-6">
				<h1 class="text-primary text-center" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.3);">Электронная Приёмная</h1>
			</div>

			<div class="col-md-5 text-center col-xs-12 col-sm-6">
				<p class="text-warning" style="margin-top: 20px;">ГБОУ средняя общеобразовательная школа № 416<br/> Петродворцового района Санкт-Петербурга</p>
			</div>

			<div class="col-md-1 col-xs-12 col-sm-6">
				<form action="" method="POST">
					<button type="submit" class="btn btn-danger btn-block" name="exit" style="margin-top: 20px;"><span class=""></span> выход</button>
				</form>
			</div>	

			<div class="col-xs-12">
				<?php
					include('../templates/menu.php');
				?>
			</div>

			<div class="col-xs-12">
				<h2 class="text-primary">Записи</h2>
			</div>

			<div class="col-xs-12">
				<h2 class="text-primary">Обращения</h2>
			</div>

			<div class="col-xs-12">
				<h2 class="text-primary">Документы ШРР</h2>
			</div>


	
		</div>
	</div>

</body>
</html>