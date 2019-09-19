<?php
	include_once 'core/connect_db.php';
	include_once 'core/csrf_protection.php';
	include_once 'core/file_upload.php';

	session_start();
	$error = ""; //файл с ошибками

	if ($_SERVER['REQUEST_METHOD'] == 'POST' and check_csrf() == 1){
		switch ('') {
			//Производим проверки на ввод данных
			case strip_tags(trim($_POST['mark'])):
				$error = "Введите марку авто";
				break;
			
			case strip_tags(trim($_POST['model'])):
				$error = "Введите модель авто";
				break;

			case strip_tags(trim($_POST['price'])):
				$error = "Укажите цену авто";
				break;

			case strip_tags(trim($_POST['body'])):
				$error = "Укажите тип кузова";
				break;

			case strip_tags(trim($_POST['description'])):
				$error = "Описание отсутствует";
				break;

			default:
				//В случае если проверки прошли успешно
				if (count($_POST['colors']) == 0){
					$error = "Укажите цвет";
				} else {
					foreach ($_POST['colors'] as $color_id) {
						$color = R::findOne('colors', 'id = ?', array($color_id));
						if (!isset($color['id'])){
							$error = "Ошибка БД";
							break;
						}
					}
						if ($error == ""){
							//Если цвета существуют
							if (is_uploaded_file($_FILES['photo']['tmp_name'])){
								$photo_address = upload_file($_FILES['photo'], __DIR__.'/img/');

								if ($photo_address != '0'){
									//Создаём запись в бд
									$car = R::dispense('cars');
									$car->mark = strip_tags($_POST['mark']);
									$car->model = strip_tags($_POST['model']);
									$car->price = strip_tags($_POST['price']);
									$car->body = strip_tags($_POST['body']);
									$car->description = strip_tags($_POST['description']);
									$car->photo = 'img/'.$photo_address;

									foreach ($_POST['colors'] as $color_id) {
										$car->sharedColorsList[] = R::load('colors', $color_id);
										R::store($car);
									}	

									//Переадресация на главную
									header('Location: http://'.$_SERVER['HTTP_HOST']);
									exit();
								} else 
									$error = "Ошибка загрузки фото";
							} else
								$error = "Ошибка загрузки фото";
						}
				}
				break;
		}
	}

	gen_csrf();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Создание машины</title>
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
		<h1>Создание авто</h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<p> Марка авто: <input type="text" name="mark" value="<?=$_POST['mark']?>"></p>
			<p> Модель авто: <input type="text" name="model" value="<?=$_POST['model']?>"></p>
			<p> Цена авто: <input type="text" name="price" value="<?=$_POST['price']?>"></p>
			<p> Тип кузова: <input type="text" name="body" value="<?=$_POST['body']?>"></p>
			<p>Выберите цвет авто</p>
			<select name="colors[]" size="5" multiple="true">
				<?php
					//Вывод цвета в selection
					$colors = R::findAll('colors');
					foreach ($colors as $color) {
						echo '<option value="'.$color['id'].'">'.$color['color'].'</option>';
					}
				?>
			</select>
			<p>Фото авто <input type="file" name="photo" accept="image/jpeg, image/png"></p>
			<p>Описание машины</p>
			<textarea name="description"><?=$_POST['description']?></textarea>
			<?= csrf_html() ?>
			<p style="color: red;"><?=$error?></p>
			<input type="submit" value="Создать">
		</form>
	</content>
</body>
</html>