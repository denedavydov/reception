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
			
			<!--шапка страницы-->
			<?php
				include('../templates/header.php');
			?>	

			<!--вывод меню-->
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


			<?php include('../templates/footer.php'); ?>

	
		</div>
	</div>

</body>
</html>