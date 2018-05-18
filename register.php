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
					echo '<li><a href="register.php">Регистрация</a></li>';
					}
					?>
				</ul>
			</nav>
		</div>
	</header>
	<div class="registration">
	<div class="outer">
	  	<div class="middle">
			<div class="inner">
				<form action="register.php" method="POST">
					Регистрация на QazOlymp
					<hr/>
					<div class = "information">
						<p>
						Имя пользователя <input type="text" name="username" placeholder="Enter a username..."><p>
					    E-mail <input type="email" name="email" placeholder="Enter an email address..."><p>
					    Пароль <input type="password" name="password" placeholder="Enter a password..."><p>
						Подтвердите пароль <input type="password" name="passwordagain" placeholder="Confirm a password..."><p>
					</div>
					<input type="submit" name="submit" value="Register">
					<p>
					<div class="errors">
						<?php
							if(isset($_POST['submit']))
							{
								$link = mysqli_connect("localhost", "qazolympalpha", "Simp2001", "qazolymp_alpha") or die($link);
								$username = mysqli_real_escape_string($link, $_POST['username']);
								$email = mysqli_real_escape_string($link, $_POST['email']);
								$password = mysqli_real_escape_string($link, $_POST['password']);
								$passwordagain = mysqli_real_escape_string($link, $_POST['passwordagain']);

								$enc_password = md5($password);

								if($username && $email && $password && $password && $passwordagain)
								{
								if($password == $passwordagain) {
									$query = mysqli_query($link, "SELECT * FROM logins WHERE username='$username'");
									$numrow = mysqli_num_rows($query);
									if ($numrow != 0) {
										echo "Данное имя пользователя занято.";
									}
									else {	
										$query = mysqli_query($link, "SELECT * FROM logins WHERE email='$email'");
										$numrow = mysqli_num_rows($query);
										if ($numrow != 0) {
											echo "Данная электронная почта уже используется.";
										}
										else { 
											if (strlen($username) > 24 || strlen($username) < 3) {
												echo "Ваш username должен иметь длину от 3 до 24 символов.";
											} else {
												$array = str_split($username);
												$tr = 0;
												foreach ($array as $char) {
													if ($char != 'a' && $char != 'b' && $char != 'c' && $char != 'd' && $char != 'e' && $char != 'f' && $char != 'g' && $char != 'h' && $char != 'i' && $char != 'j' && $char != 'k' && $char != 'l' && $char != 'm' && $char != 'n' && $char != 'o' && $char != 'p' && $char != 'q' && $char != 'r' && $char != 's' && $char != 't' && $char != 'u' && $char != 'v' && $char != 'w' && $char != 'x' && $char != 'y' && $char != 'z' && $char != 'A' && $char != 'B' && $char != 'C' && $char != 'D' && $char != 'E' && $char != 'F' && $char != 'G' && $char != 'H' && $char != 'I' && $char != 'J' && $char != 'K' && $char != 'L' && $char != 'M' && $char != 'N' && $char != 'O' && $char != 'P' && $char != 'Q' && $char != 'R' && $char != 'S' && $char != 'T' && $char != 'U' && $char != 'V' && $char != 'W' && $char != 'X' && $char != 'Y' && $char != 'Z' && $char != '0' && $char != '1' && $char != '2' && $char != '3' && $char != '4' && $char != '5' && $char != '6' && $char != '7' && $char != '8' && $char != '9') {
														$tr = 1;
													}
												}
												
												if ($tr == 1) {
													echo "Формат username'a это a-z, A-Z, 0-9.";
												} else {
														$confirmcode = rand();
														$query = mysqli_query($link, "INSERT INTO `logins` VALUES('','$username','$enc_password','$email','0','$confirmcode')");

														$message =
														"
														Подтверждение почты.
														Перейдите по ниже расположенной ссылке, чтобы подтвердить почту.

														http://qazolympalpha.go-host.kz/emailconfirm.php?username=$username&code=$confirmcode

														Qazolymp team.
														";

														mail($email,"Подтверждение",$message,"From: admin@qazolymp.kz");

														echo "Регистрация пройдена! Пожалуйста подтвердите вашу почту, перейдя по ссылке которую мы вам прислали.";
													}
												}
										}
									}
								} else {
									echo "Пароли не соответствует.";
								}
							}
							else {
								echo "Заполните все необходимые поля.";
							}
						}
					?>
				</div>
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