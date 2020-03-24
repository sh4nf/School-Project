<html>
<head>
	<style type="text/css">
		body{
			background-color: #fcfcfc;
		}
		.block{
			width: 100%;
			height: 100%;
			text-align: center;
		}

		.post{
			border: 1px solid grey;
			width: 90%;
			margin: auto;
			margin-top: 10px;
		}

		h1{
			font-size: 30px;
			margin: 0;
			padding: 0;
		}
	</style>
	<title>Мой блог</title>
</head>
<body>
	<div class='block'>
	<?php
		# Подключение к базе данных
		include 'db.php';
		$conn = dbCONN();
		###########################

		if((!empty($_POST['author'])) AND (!empty($_POST['content'])) AND (!empty($_POST['title']))){
			$author = $_POST['author'];
			$content = $_POST['content'];
			$title = $_POST['title'];

			$sql = 'INSERT INTO posts (author, title, content) VALUES ("' . $author . '","' . $title . '","' . $content . '");';
			mysqli_query($conn, $sql);
		}

		# Запрос к базе данных
		$sql = 'SELECT * FROM posts';
		$result = $conn->query($sql);
		##########################################

		# Обработка полученных данных (уязвимое место)
		while($row = $result->fetch_assoc()){
			echo "<div class='post'><h1>Post: " . $row['post_id'] . ' ' . $row['title'] . ' by: ' . $row['author'] . '</h1><p>' . $row['content'] . '</p></div>';
		}
		#############################
	?>
		<div class='post'>
			<form method="POST">
				<h1>Создать свой пост</h1>
				<p><input type="text" name="author" placeholder="Ваше имя"></p>
				<p><input type="text" name="title" placeholder="Название поста"></p>
				<p><input type="text" name="content" placeholder="Послание всем"></p>
				<button type="submit">Отправить</button>
			</form>
		</div>
	</div>
	
</body>
</html>
