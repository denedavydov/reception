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
  <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
	<title><?php echo $_SESSION['name'];?></title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="style.css?<?php echo time(); ?>" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="apple-touch-icon" sizes="152x152" href="favicon.png" />
	<script src="js/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">

			<!--шапка страницы-->
      <div class="col-md-1 col-xs-12 col-sm-6">
      	<p class="text-center">
      		<img src="img/logo.jpg" alt="логотип" width="100" />
      	</p>
      </div>

      <div class="col-md-5 col-xs-12 col-sm-6">
      	<h1 class="text-primary text-center" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.3);">Личный кабинет</h1>
      </div>

      <div class="col-md-4 text-center col-xs-12 col-sm-6">
      	<p class="text-warning" style="margin-top: 20px;">ГБОУ средняя общеобразовательная школа № 416<br/> Петродворцового района Санкт-Петербурга</p>
      </div>

      <div class="col-md-2 col-xs-12 col-sm-6">
      	<form action="" method="POST">
      		<button type="submit" class="btn btn-danger btn-block" name="exit" style="margin-top: 20px;"><span class="glyphicon glyphicon-log-out"></span> Выход</button>
      	</form>
      </div>

			<!--вывод меню-->
			<div class="col-xs-12">
        <ul class="nav nav-tabs">
          <hr class="hidden-sm hidden-md hidden-lg"/>
        	<li role="presentation"><a href="<?php $_SESSION['page'] = $_SESSION['id'].'/'.'user=id_'.$_SESSION['id']; echo 'resources/'.$_SESSION['page'].'.php' ?>" style="cursor: pointer;"><span class="glyphicon glyphicon-home"></span> <?php echo  $_SESSION['name']; ?> </a></li>
        	<li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-th-list"></span> Услуги <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li role="presentation"><a href="#"><span class="glyphicon glyphicon-pencil"></span> Записаться на прием</a></li>
              <li role="presentation"><a href="<?php echo 'resources/'.$_SESSION['page'].'-appeals_'.$_SESSION['id'].'.php'; ?>"><span class="glyphicon glyphicon-file"></span> Подача обращения </a></li>
              <li role="presentation"><a href="#"><span class="glyphicon glyphicon-open-file"></span> Запись в ШРР</a></li>
              <li role="presentation"><a href="#"><span class="glyphicon glyphicon-open-file"></span> Запись в летний лагерь</a></li>
            </ul>
          </li>
        	<li role="presentation" class="active"><a href="<?php echo 'resources/'.$_SESSION['page'].'-account_settings_'.$_SESSION['id'].'.php'; ?>"><span class="glyphicon glyphicon-user"></span> Личный кабинет</a></li>
        </ul>
			</div>

			<div class="col-xs-12">
				<h2 class="text-primary">Настройка профиля</h2>
			</div>

			<div class="col-xs-12 text-primary" method="get">
        <h5>Имя пользователя:</h5>
        <input type="text" name="name" value="<?php echo $_SESSION['name']; ?>">
        <button type="button" name="name">Изменить</button>
			</div>

			<!--подвал-->
			<div class="col-xs-12 text-center">
				<?php include('../../templates/footer.php'); ?>
			</div>


		</div>
	</div>

</body>
</html>
