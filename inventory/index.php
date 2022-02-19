<?php
	session_start();
	$_SESSION['csrf'] = random_int(1,9999999);
	require '../src/configDB.php';
	$sql = 'SELECT `persist-case`, `balance` FROM `accounts` WHERE login = :login';
				
	$stmt = $pdo->prepare($sql);
    $stmt->bindParam('login', $_COOKIE['user'], PDO::PARAM_STR, 128);
	$stmt->execute();
	$current = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../src/css/style.css">
	<title>Log-in</title>
</head>
<body>
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
					$sql = 'SELECT `balance`, `avatar`, `family-case`, `border-case`, `addicted-case`, `persist-case`, `compartment-case` FROM `accounts` WHERE login = :login';
				
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam('login', $_COOKIE['user'], PDO::PARAM_STR, 128);
					$stmt->execute();
					$user = $stmt->fetch(PDO::FETCH_ASSOC);
					echo '<a href="/">balance: '.$user['balance'].'$</a>';
				
					echo "<a href='../settings'/>settings</a>";
				echo "<a href='/src/exit.php'>log out (".$_COOKIE['user'].")</a>";

				$avatar = $user['avatar'];
				echo "<img src='../src/img/avatars/".$avatar.".png' style='height: 25px; transform: translateY(20%); margin-left: 15px;'>";
				endif;
			?>
		</span>
	</div>
	<div class="main">
		<div class="main-content">
			<?php
				if($user['family-case'] == 0 && $user['border-case'] == 0 && $user['addicted-case'] == 0 && $user['persist-case'] == 0 && $user['compartment-case'] == 0) {
					echo '<label>Ваш инвентарь пуст.</label>';
					echo $user['addicted-case'];
				}
				if($user['family-case']!=0)
				{
			?>
			<a href="../opencase/15" class="case-block">
				<img src="../src/img/case.png" alt="family-case">
				<? echo '<p>family case ('.$user["family-case"].' шт.)</p>'?>
				<p class="case-price">open</p>
				<div class="case-bg"></div>
			</a>
			<?php
				}
				if($user['border-case']!=0)
				{
			?>
			<a href="../opencase/20" class="case-block">
				<img src="../src/img/case.png" alt="border-case">
				<? echo '<p>border case ('.$user["border-case"].' шт.)</p>'?>
				<p class="case-price">open</p>
				<div class="case-bg"></div>
			</a>
			<?php
				}
				if($user['addicted-case']!=0)
				{
			?>
			<a href="../opencase/25" class="case-block">
				<img src="../src/img/case.png" alt="addicted-case">
				<? echo '<p>addicted case ('.$user["addicted-case"].' шт.)</p>'?>
				<p class="case-price">open</p>
				<div class="case-bg"></div>
			</a>
			<?php
				}
				if($user['persist-case']!=0)
				{
			?>
			<a href="../opencase/50" class="case-block">
				<img src="../src/img/case.png" alt="persist-case">
				<? echo '<p>persist case ('.$user["persist-case"].' шт.)</p>'?>
				<p class="case-price">open</p>
				<div class="case-bg"></div>
			</a>
			<?php
				}
				if($user['compartment-case']!=0)
				{
			?>
			<a href="../opencase/100" class="case-block">
				<img src="../src/img/case.png" alt="compartment-case">
				<? echo '<p>compartment case ('.$user["compartment-case"].' шт.)</p>'?>
				<p class="case-price">open</p>
				<div class="case-bg"></div>
			</a>
			<?php
				}
			?>
		</div>
	</div>
	<script src="../src/js/wow.min.js"></script>
	<script>
	    new WOW().init();
	</script>
</body>
</html>









<!-- $sql = 'SELECT `persist-case`, `balance` FROM `accounts` WHERE login = :login';
				
		$stmt = $pdo->prepare($sql);
        $stmt->bindParam('login', $_COOKIE['user'], PDO::PARAM_STR, 128);
		$stmt->execute();
		$current = $stmt->fetch(PDO::FETCH_ASSOC); -->