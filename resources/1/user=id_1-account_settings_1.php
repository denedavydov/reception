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
<body>

	<div class="container">
		<div class="row">

			<!--шапка страницы-->
			<?php
				include('../../templates/header.php');
			?>

			<!--вывод меню-->
			<div class="col-xs-12">
		        <ul class="nav nav-tabs hidden-xs">
		          <hr class="hidden-sm hidden-md hidden-lg"/>
		        	<li role="presentation"><a href="<?php $_SESSION['page'] = $_SESSION['id'].'/'.'user=id_'.$_SESSION['id']; echo 'resources/'.$_SESSION['page'].'.php' ?>" style="cursor: pointer;"><span class="glyphicon glyphicon-home"></span> <?php echo  $_SESSION['name']; ?> </a></li>
		        	<li role="presentation" class="dropdown">
		            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		              <span class="glyphicon glyphicon-th-list"></span> Услуги <span class="caret"></span>
		            </a>
		            <ul class="dropdown-menu">
		              <li role="presentation"><a href="<?php echo 'resources/'.$_SESSION['page'].'-appointments_'.$_SESSION['id'].'.php'; ?>"><span class="glyphicon glyphicon-pencil"></span> Записаться на прием</a></li>
		              <li role="presentation"><a href="<?php echo 'resources/'.$_SESSION['page'].'-appeals_'.$_SESSION['id'].'.php'; ?>"><span class="glyphicon glyphicon-file"></span> Подача обращения </a></li>
		              <li role="presentation"><a href="#"><span class="glyphicon glyphicon-open-file"></span> Запись в ШРР</a></li>
		              <li role="presentation"><a href="#"><span class="glyphicon glyphicon-open-file"></span> Запись в летний лагерь</a></li>
		            </ul>
		          </li>
		        	<li role="presentation" class="active"><a href="<?php echo 'resources/'.$_SESSION['page'].'-account_settings_'.$_SESSION['id'].'.php'; ?>"><span class="glyphicon glyphicon-user"></span> Личный кабинет</a></li>
		        </ul>
			</div>

			<!-- Меню мобильной версии-->
			<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
			  <br/>
			  <nav role="navigation" class="navbar navbar-default">
			    <!-- Логотип и мобильное меню -->
			    <div class="navbar-header">
			    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			    </button>
			      <a href="<?php $_SESSION['page'] = $_SESSION['id'].'/'.'user=id_'.$_SESSION['id']; echo 'resources/'.$_SESSION['page'].'.php' ?>" class="navbar-brand"> <span class="glyphicon glyphicon-home"></span> <?php echo  $_SESSION['name']; ?></a>
			    </div>
			    <!-- Навигационное меню -->
			      <div id="navbarCollapse" class="collapse navbar-collapse">
			        <ul class="nav navbar-nav">
			    <!-- Выподающие меню с подпунктами -->
			          <li class="dropdown">
			          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			            <span class="glyphicon glyphicon-th-list"></span> Услуги <span class="caret"></span>
			          </a>
			          <ul role="menu" class="dropdown-menu">
			            <li role="presentation"><a href="<?php echo 'resources/'.$_SESSION['page'].'-appointments_'.$_SESSION['id'].'.php'; ?>"><span class="glyphicon glyphicon-pencil"></span> Записаться на прием</a></li>
			            <li role="presentation"><a href="<?php echo 'resources/'.$_SESSION['page'].'-appeals_'.$_SESSION['id'].'.php'; ?>"><span class="glyphicon glyphicon-file"></span> Подача обращения </a></li>
			            <li role="presentation"><a href="#"><span class="glyphicon glyphicon-open-file"></span> Запись в ШРР</a></li>
			            <li role="presentation"><a href="#"><span class="glyphicon glyphicon-open-file"></span> Запись в летний лагерь</a></li>
			          </ul>
			        </li>
			        <li role="presentation"><a href="<?php echo 'resources/'.$_SESSION['page'].'-account_settings_'.$_SESSION['id'].'.php'; ?>"><span class="glyphicon glyphicon-user"></span> Личный кабинет</a> <hr/></li>
			        <li><button type="submit" class="btn btn-danger btn-block" name="exit" style="margin: 5px 0px 5px 0px;"><span class="glyphicon glyphicon-log-out"></span> Выход</button></li>
			      </ul>
			      </div>
			  </nav>
			</div>
			

			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<h2 class="text-primary">Настройка профиля</h2>
			</div>

			<form action="" method="POST" class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

				<label>Логин пользователя:</label>
				<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"></span>
						<input type="text" name="name" autocomplete="off" class="form-control" placeholder="<?php echo $_SESSION['name']; ?>" aria-describedby="basic-addon1">
				</div><br/>

				<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"></span>
						<input type="text" name="name" autocomplete="off" class="form-control" placeholder="<?php  ?>" aria-describedby="basic-addon1">
				</div><br/>

				<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"></span>
						<input type="password" name="password" maxlength="8" minlength="6" autocomplete="off" class="form-control" placeholder="Пароль пользователя" aria-describedby="basic-addon1">
				</div><br/>

				<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"></span>
						<input type="password" name="password" maxlength="8" minlength="6" autocomplete="off" class="form-control" placeholder="Электронная почта" aria-describedby="basic-addon1">
				</div><br/>

				<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"></span>
						<input type="password" name="password" maxlength="8" minlength="6" autocomplete="off" class="form-control" placeholder="Паспорт" aria-describedby="basic-addon1">
				</div><br/>

				<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"></span>
						<input type="password" name="password" maxlength="8" minlength="6" autocomplete="off" class="form-control" placeholder="ФИО ребёнка" aria-describedby="basic-addon1">
				</div><br/>

				<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"></span>
						<input type="password" name="password" maxlength="8" minlength="6" autocomplete="off" class="form-control" placeholder="Класс ребёнка" aria-describedby="basic-addon1">
				</div><br/>

					<button type="submit" class="btn btn-primary" name="enter"><span class="glyphicon glyphicon-edit"></span> Сохранить изменения </button>
			</form>

			<!--подвал-->
			<div class="col-xs-12 text-center">
				<?php include('../../templates/footer.php'); ?>
			</div>


		</div>
	</div>

</body>
</html>
