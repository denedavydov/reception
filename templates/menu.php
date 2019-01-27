<ul class="nav nav-tabs">
	<li role="presentation" class="active"><a href="<?php echo 'resources/'.$_SESSION['page'].'.php' ?>" style="cursor: pointer;"><span class="glyphicon glyphicon-home"></span> <?php echo  $_SESSION['name']; ?> </a></li>
	<li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <span class="glyphicon glyphicon-th-list"></span> Услуги <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <li role="presentation"><a href="#"><span class="glyphicon glyphicon-pencil"></span> Записаться на прием</a></li>
      <li role="presentation"><a href="#"><span class="glyphicon glyphicon-file"></span> Подача обращения</a></li>
      <li role="presentation"><a href="#"><span class="glyphicon glyphicon-open-file"></span> Запись в ШРР</a></li>
      <li role="presentation"><a href="#"><span class="glyphicon glyphicon-open-file"></span> Запись в летний лагерь</a></li>
    </ul>
  </li>
	<li role="presentation"><a href="#"><span class="glyphicon glyphicon-user"></span> Личный кабинет</a></li>
</ul>