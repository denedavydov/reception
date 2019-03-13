<?php
	include('../../templates/session_start.php');
?>
<?php
	include('../../templates/session_close.php');
?>

<?php 
	include('../../templates/config.php');

    $link = mysql_connect($db_path, $db_login, $db_password);
	mysql_select_db($db_name) or die("Не найдена БД");
	mysql_query('SET NAMES utf8');

	if (isset($_POST['answer'])) {
    	$login = htmlspecialchars($_SESSION['username']);
    	$passport = htmlspecialchars($_POST['passport']);
    	$name = htmlspecialchars($_POST['name']);
    	$surname = htmlspecialchars($_POST['surname']);

    	$query = "UPDATE `users` SET `name` = '$surname', `surname` = '$name', `passport` = '$passport' WHERE `users`.`login` = '$login'";
    	$result = mysql_query($query);

    	$query = "SELECT `password` FROM users WHERE `login` = '$login'";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);

		if ($num_rows != 0) {
			while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        		foreach ($line as $col_value) {
	                $pass = $col_value;
	                }
        		}
        }

    	if ($_POST[old_password] != none and $_POST[old_password] == $pass){
    		if ($_POST[new_password1] == $_POST[new_password2]) {
    			$query = "UPDATE `users` SET `password` = '$_POST[new_password1]' WHERE `users`.`login` = '$login'";
    			$result = mysql_query($query);
    		}else{echo "Пароли не совподают";}
    	}else{echo "Неправильный пароль";}
    }

    mysql_free_result($result);
    mysql_close($link);
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

				<label>Фамилия:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						  <input type="text" name="name" value="<?php echo $_SESSION['surname']; ?>" required="" autocomplete="off" class="form-control" placeholder="Ваша фамилия" aria-describedby="basic-addon1">
					</div><br/>
					<label>Имя Отчество:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						  <input type="text" name="surname" value="<?php echo $_SESSION['name']; ?>" required="" autocomplete="off" class="form-control" placeholder="Ваше имя и отчество" aria-describedby="basic-addon1">
					</div><br/>
					<label>Адрес электронной почты:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
						  <input value="<?php echo $_SESSION['username']; ?>" class="form-control" aria-describedby="basic-addon1" readonly>
					</div><br/>
					<label>Серия и номер паспорта:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-book"></span></span>
						  <input type="text" name="passport" value="<?php echo $_SESSION['passport']; ?>" autocomplete="off" minlength="9" maxlength="10" required="" class="form-control" placeholder="серия и номер Вашего паспорта (10 цифр подряд без пробелов)" aria-describedby="basic-addon1">
					</div><br/>
					<label>Роль:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-cog"></span></span>
						  <select class="form-control" name="status" required="">
						  	<option><?php echo $_SESSION['status']; ?></option>
						  	<option><?php if($_SESSION['status'] == 'Законный представитель обучающегося') {echo "Родитель обучающегося";} else { echo "Законный представитель обучающегося";} ?></option>
						  </select>
					</div><br/>
					<label>Изменение пароля:</label>
					<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
						  <input type="password" name="old_password" required="" minlength="6" maxlength="8" autocomplete="off" class="form-control" placeholder="Введите текущий пароль" aria-describedby="basic-addon1">

						  <input type="password" name="new_password1" required="" minlength="6" maxlength="8" autocomplete="off" class="form-control" placeholder="Введите новый пароль" aria-describedby="basic-addon1">

						  <input type="password" name="new_password2" required="" minlength="6" maxlength="8" autocomplete="off" class="form-control" placeholder="Повторите пароль" aria-describedby="basic-addon1">
					</div><br/>

					<button type="submit" class="btn btn-success" name="answer"><span class="glyphicon glyphicon-edit"></span> Сохранить изменения </button>
			</form>

			<!--подвал-->
			<div class="col-xs-12 text-center">
				<?php include('../../templates/footer.php'); ?>
			</div>


		</div>
	</div>

</body>
</html>
