<?php
	session_start();
	$_SESSION['csrf'] = random_int(1,9999999);
	require 'src/configDB.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="src/css/style.css">
	<link rel="icon" href="../../src/img/case.png" type="image/x-icon">
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
					$sql = 'SELECT balance, avatar FROM accounts WHERE login = :login';
				
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
								$size = getimagesize("src/img/avatars/".$user['avatar']);
								if($size[0]>$size[1]) {
									echo '<img onclick="dropmenu()" src="src/img/avatars/'.$user['avatar'].'" alt="avatar" style="max-height: 100%;">';
								}
								else {
									echo '<img onclick="dropmenu()" src="src/img/avatars/'.$user['avatar'].'" alt="avatar" style="max-width: 100%;">';
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
			<form action="buycase/15-handler.php" method="post" id="buycase-15" class="buycase-form" onsubmit="return buycase(15)">
					<a class="case-block">
						<input type="submit" class="buycase-submit" value=''/>
						<img src="src/img/case.png" alt="case">
						<p>silver case</p>
						<p class="case-price">50$</p>
						<div class="case-bg" ></div>
						<input type="hidden" value="<?=$_SESSION['csrf'];?>" name="token">
					</a>
			</form>
			<form action="buycase/20-handler.php" method="post" id="buycase-15" class="buycase-form" onsubmit="return buycase(15)">
					<a class="case-block">
						<input type="submit" class="buycase-submit" value=''/>
						<img src="src/img/case.png" alt="case">
						<p>border case</p>
						<p class="case-price">100$</p>
						<div class="case-bg" ></div>
						<input type="hidden" value="<?=$_SESSION['csrf'];?>" name="token">
					</a>
			</form>
			<form action="buycase/25-handler.php" method="post" id="buycase-15" class="buycase-form" onsubmit="return buycase(15)">
					<a class="case-block">
						<input type="submit" class="buycase-submit" value=''/>
						<img src="src/img/case.png" alt="case">
						<p>addicted case</p>
						<p class="case-price">150$</p>
						<div class="case-bg" ></div>
						<input type="hidden" value="<?=$_SESSION['csrf'];?>" name="token">
					</a>
			</form>
			<form action="buycase/50-handler.php" method="post" id="buycase-15" class="buycase-form" onsubmit="return buycase(15)">
					<a class="case-block">
						<input type="submit" class="buycase-submit" value=''/>
						<img src="src/img/case.png" alt="case">
						<p>persist case</p>
						<p class="case-price">250$</p>
						<div class="case-bg" ></div>
						<input type="hidden" value="<?=$_SESSION['csrf'];?>" name="token">
					</a>
			</form>
			<form action="buycase/100-handler.php" method="post" id="buycase-15" class="buycase-form" onsubmit="return buycase(15)">
					<a class="case-block">
						<input type="submit" class="buycase-submit" value=''/>
						<img src="src/img/case.png" alt="case">
						<p>compartment case</p>
						<p class="case-price">500$</p>
						<div class="case-bg" ></div>
						<input type="hidden" value="<?=$_SESSION['csrf'];?>" name="token">
					</a>
			</form>
			<div id="opencase-modal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<p>log in to buy</p>
				</div>
			</div>
		</div>
	</div>
	
	<script src="src/js/buycase.js"></script>
	<script src="src/js/dropdown.js"></script>
	<script src="src/js/wow.min.js"></script>
	<script>
	    new WOW().init();
	</script>
</body>
</html>