<html>
<head>
	<style type="text/css">
		.content{
			text-align: center;
			border: 1px solid grey;
		}
		h1{
			font-size: 30px;
			margin: 0;
			padding: 0;
		}
		.note{
			border: 1px solid grey;
			width: 100%;
			margin: 0;
			padding: 0;
		}
	</style>
	<title>Заметки</title>
</head>
<body>
	<div class="content">
		<form method="POST">
			<h1>Найти заметки пользователя с именем: </h1>
			<p><input type="text" name="name" placeholder="Имя"></p>
			<button type="submit">Найти</button>
		</form>
		<?php 
			# Подключение к бд
			include 'db.php';
			$conn = dbCONN();

			# Получение заметок по имени
			if(!empty($_POST['name'])){
				$name = $_POST['name'];

				# FIXED

				#Подготовка запроса
				$sql = 'SELECT * FROM users WHERE name=?';
				$stmt = mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt, $sql);
				mysqli_stmt_bind_param($stmt, "s", $name);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				############################
				
				# Обработка полученных данных
				while($row = $result->fetch_assoc()){
					$data = 'Заметка ' . $row['user_id'] . ' пользователя ' . $row['name'] . ' : ' . $row['secret_word'];
					echo '<p class="note">' . $data . '</p>';
				}
			}
		?>
	</div>
</body>
</html>