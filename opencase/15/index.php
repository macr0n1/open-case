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
	<link rel="icon" href="../../src/img/case.png" type="image/x-icon">
	<title>Log-in</title>
</head>
<body onload="generate()">
	<div class="header">
		<span class="main-ref">
			<a href="/">main page</a>
		</span>
		<span class="log-status">
			
			<?php
				if($_COOKIE['user'] == ''):
			?>	
			<a class="header-a" href="/login">authorization</a>
			<a class="header-a" href="/registration">registration</a>
			<?php
				else:
					$sql = 'SELECT `balance`, `avatar`, `silver-case` FROM `accounts` WHERE login = :login';
				
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam('login', $_COOKIE['user'], PDO::PARAM_STR, 128);
					$stmt->execute();
					$user = $stmt->fetch(PDO::FETCH_ASSOC);
			?>
			
			<div class="dropdown">
				<a onclick="dropmenu()" class="dropbtn">
					<?=$_COOKIE['user']?>
					<div class="avatar-img-wrap">
						<span class="avatar-img-center">
							<?php
								$size = getimagesize("../../src/img/avatars/".$user['avatar']);
								if($size[0]>$size[1]) {
									echo '<img onclick="dropmenu()" src="../../src/img/avatars/'.$user['avatar'].'" alt="avatar" style="max-height: 100%;">';
								}
								else {
									echo '<img onclick="dropmenu()" src="../../src/img/avatars/'.$user['avatar'].'" alt="avatar" style="max-width: 100%;">';
								}
							?>
						</span>
					</div>
				</a>
				<div id="myDropdown" class="dropdown-content">
					<a href="/">balance: <?=$user['balance']?>$</a>
					<a href="/inventory">inventory</a>
					<a href='/settings'>settings</a>
					<a href='/src/exit.php'>log out</a>
				</div>
			</div>

			<?php
				endif;
			?>
		</span>
	</div>
	<div class="main">
		<?if($_COOKIE['user'] != ''):?>
			<a class="case-block">
			<img src="../../src/img/case.png" alt="case">
			<? echo '<p>silver case ('.$user["silver-case"].' шт.)</p>'?>
			<p class="case-price">win rate 1.5x</p>
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
		<div id="opencase-modal" class="modal">
			<div class="modal-content">
				<span class="close">&times;</span>
				<p>you have 0 cases</p>
			</div>
		</div>
		<?else:?>
		<label>log in to view</label>
		<?endif?>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="../../src/js/dropdown.js"></script>
	    <script src='../../src/js/roulette.js'></script>
	</div>
</body>
</html>