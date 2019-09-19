<?php
	include_once 'core/connect_db.php';
	if (isset($_GET['page'])){
		// $start - начало выборки $end - конец
		$end = $_GET['page'] * 5;
		$start = $end - 5;

		$cars = R::getAll('SELECT * FROM cars ORDER BY id DESC LIMIT '.$start.', '.$end);
	} else {
		$cars = R::getAll('SELECT * FROM cars ORDER BY id DESC LIMIT 1, 5');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Каталог авто</title>
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
		<h1 style="text-align: center;">Каталог авто</h1>
		<table>
			<?php
				foreach ($cars as $car) {
					echo '<tr>
						<td><a href="http://'.$_SERVER['HTTP_HOST'].'/concrete_auto.php?car='.$car['id'].'">
							<img src="'.$car['photo'].'">
						</a></td>
						<td><a href="http://'.$_SERVER['HTTP_HOST'].'/concrete_auto.php?car='.$car['id'].'">
							Марка: '.$car['mark'].' Модель: '.$car['model'].'
						</a></td>
						<td>
							Цена: '.$car['price'].'
						</td>
						<td>
							Описание: '.substr($car['description'], 0, 250).'
						</td>
						</tr>';
				}
			?>
		</table>
		<div>
			Страницы: 
			<?php
				//Вывод счётчика страниц
				$count_pages = ceil(count(R::findAll('cars')) / 5);
				for ($page_number = 1; $page_number <= $count_pages; $page_number++){
					echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/index.php?page='.$page_number.'">'.$page_number.' </a>';
				}
			?>
		</div>
	</content>
</body>
</html>