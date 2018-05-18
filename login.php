<?php 
	session_start();
	if($_SESSION['username']) {
		header('location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="URL-8">
<head>
	<meta charset="UTF-8" />
	<title>QazOlymp</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/loginstyle.css">
	<script>
	function startTime() {
	    var today = new Date();
	    var h = today.getHours();
	    var m = today.getMinutes();
	    var s = today.getSeconds();
	    m = checkTime(m);
	    s = checkTime(s);
	    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
	    var t = setTimeout(startTime, 500);
	}
	function checkTime(i) {
	    if(i < 10) {i = "0" + i};
	    return i;
	}
	</script>
</head>

<body onload = "startTime()">
	<div class = "container">
		<a href = "/"><img src="image/logo.png" alt="QazOlymp" class="logo"></a>
	</div>
	<header>
		<div class = "container">
			<nav class = "navigation">
				<ul>
					<li><a href="index.php">Новости</a></li>
					<li><a href="#">Предметы</a>
						<ul class="submenu">
			                <li><a href=#>Метематика</a></li>
			                <li><a href=#>Физика</a></li>
			                <li><a href=#>Информатика</a></li>
			                <li><a href=#>Химия</a></li>
			                <li><a href=#>Биология</a></li>
			                <li><a href=#>География</a></li>
			            </ul>
					</li>
					<li><a href="#">Галерея</a></li>
					<li><a href="#">О нас</a></li>
				</ul>
			</nav>
			<nav class = "loginAndRegistrButton">
				<ul>
					<?php 
					session_start();
					if($_SESSION['username'])
					{
					echo '<li><a href="#">Профиль</a></li>';
					echo '<li><a href="logout.php">Выйти</a></li>';
					} else {
					echo '<li><a href="login.php">Вход</a></li>';
					echo '|';
					echo '<li><a href="register.php">Регистрация</a></li>';
					}
					?>
				</ul>
			</nav>
		</div>
	</header>
	<div class="login">
		<div class="outer">
		  	<div class="middle">
				<div class="inner">
					<form action="action.php" method="POST">
						Вход в QazOlymp
						<hr/>
						<div class = "information">
							<p>
							Имя пользователя <input type="text" name="username" placeholder="Enter a username..."><p>
							Пароль <input type="password" name="password" placeholder="Enter a password..."><p>
						</div>
						<input type="submit" value="Login"> 
					<?php
						if (isset($_GET['error'])) {
							echo '<p style = "color: red; text-align: center" >' .  $_GET['error'] . '</p>';
						}
					?>
					</form>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class = "container">
			<hr/>
			QazOlymp	
			<div id = "time"></div>
		</div>
	</footer>
</body>
</html>