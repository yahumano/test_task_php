<?php
	include_once 'core/connect_db.php';

	$car = R::findOne('cars', 'id = ?', array($_GET['car']));
	if (!isset($car['id'])){
		R::close();
		exit('<h1 style="text-align: center;">Ошибка!</h1>');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Информация об авто</title>
</head>
<body>
	<header>
		<ul>
			<li>
				<a href="http://<?=$_SERVER['HTTP_HOST']?>">Главная</a>
			</li>
			<li>
				<a href="http://<?=$_SERVER['HTTP_HOST']?>/make_auto.php">Создать авто</a>
			</li>
		</ul>
	</header>
	<content>
		<p>Информация о машине</p>
		<p>1. <?=$car['mark']?></p>
		<p>2. <?=$car['model']?></p>
		<p>3. <?=$car['price']?></p>
		<p>4. <?=$car['body']?></p>
		<p>5. 
			<?php
				$car_colors = $car->sharedColorsList;

				foreach ($car_colors as $car_color) {
					echo $car_color['color'].' ';
				}
			?>
		</p>
		<p>6. <?=$car['description']?>
	</content>
</body>
</html>