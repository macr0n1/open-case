<?php
	session_start();
	$_SESSION['csrf'] = random_int(1,9999999);
	require '../src/configDB.php';
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
					$sql = 'SELECT balance, avatar FROM accounts WHERE login = :login';
				
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
			<div class="authorization">
				<form action="handler.php" method="post">
					<input type="hidden" value="<?=$_SESSION['csrf'];?>" name="token">
					
					<label>authorization</label>
					<br />
					<input name="login" placeholder="login" required></input>
					<br />
					<input name="password" placeholder="password" required type="password"></input>
					<br />
					<input type="submit" id="submit" value="send"/>
				</form>
			</div>
		</div>
	</div>
</body>
</html>