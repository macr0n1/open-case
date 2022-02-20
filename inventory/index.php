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
	<link rel="icon" href="../src/img/case.png" type="image/x-icon">
	<title>Log-in</title>
</head>
<body>
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
					$sql = 'SELECT `balance`, `avatar`, `silver-case`, `border-case`, `addicted-case`, `persist-case`, `compartment-case` FROM `accounts` WHERE login = :login';
				
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
								$size = getimagesize("../src/img/avatars/".$user['avatar']);
								if($size[0]>$size[1]) {
									echo '<img onclick="dropmenu()" src="../src/img/avatars/'.$user['avatar'].'" alt="avatar" style="max-height: 100%;">';
								}
								else {
									echo '<img onclick="dropmenu()" src="../src/img/avatars/'.$user['avatar'].'" alt="avatar" style="max-width: 100%;">';
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
		<div class="main-content">
			<?if($_COOKIE['user'] != ''):
				if($user['silver-case'] == 0 && $user['border-case'] == 0 && $user['addicted-case'] == 0 && $user['persist-case'] == 0 && $user['compartment-case'] == 0) {
					echo '<label>your inventory is empty</label>';
				}
				if($user['silver-case']!=0)
				{
			?>
			<a href="../opencase/15" class="case-block">
				<img src="../src/img/case.png" alt="silver-case">
				<? echo '<p>silver case ('.$user["silver-case"].' шт.)</p>'?>
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
			<?else:?>
			<label>log in to view</label>
			<?endif?>
		</div>
	</div>
	<script src="../src/js/dropdown.js"></script>
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