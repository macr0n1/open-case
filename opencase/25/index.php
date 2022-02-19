<?php
	session_start();
	$_SESSION['csrf'] = random_int(1,9999999);
	require '../../src/configDB.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/css/style.css">
	<title>Log-in</title>
</head>
<body onload="generate()">
	<div class="header">
		<span class="site-eby">
			<a href="/">main page</a>
		</span>
		<span class="log-status">
			
			<?php
				if($_COOKIE['user'] == ''):
			?>	
			<a href="/login">authorization</a>
			<a href="/registration">registration</a>
			<?php
				else:
			?>
			<a href="/inventory">inventory</a>
			<?php 
					$sql = 'SELECT `balance`, `avatar`, `addicted-case` FROM accounts WHERE login = :login';
				
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam('login', $_COOKIE['user'], PDO::PARAM_STR, 128);
					$stmt->execute();
					$user = $stmt->fetch(PDO::FETCH_ASSOC);
					echo '<a href="/">balance: '.$user['balance'].'$</a>';
				
				echo "<a href='../settings'/>settings</a>";
				echo "<a href='/src/exit.php'>log out (".$_COOKIE['user'].")</a>";

				$avatar = $user['avatar'];
				echo "<img src='../../src/img/avatars/".$avatar.".png' style='height: 25px; transform: translateY(20%); margin-left: 15px;'>";
				endif;
			?>
		</span>
	</div>
	<div class="main">
		<a class="case-block">
			<img src="../../src/img/case.png" alt="case">
			<? echo '<p>addicted case ('.$user["addicted-case"].' шт.)</p>'?>
			<p class="case-price">150$</p>
		</a>
		<div class="roulette">
			<div class="roulette-border"></div>
			<div class="roulette-main">
				<div class="result"></div>
				<div class="slots" id="slots" style="right: 0px">
				</div>
			</div>
			<button class="roulette-btn" onclick="start()" id="opencase-btn">open</button>
		</div>
		<div id="opencase-modal" class="modal"> -->
			<div class="modal-content">
				<span class="close">&times;</span>
				<p>log in to scroll</p>
			</div>
		</div>
	    <script src='../../src/js/roulette.js'></script>
	</div>
</body>
</html>