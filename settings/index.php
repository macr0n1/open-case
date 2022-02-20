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
	<link rel="icon" href="../../src/img/case.png" type="image/x-icon">
	<link rel="stylesheet" href="../src/css/style.css">
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
			<?if($_COOKIE['user'] != ''):?>
			<div class="avatar">	
				<form onsubmit="return emptyCheck()" class="avatar-upload" action="handler.php" method="post" enctype="multipart/form-data">
					<input type="hidden" value="<?=$_SESSION['csrf'];?>" name="token">
					<label>upload your avatar</label><br>
					<input type="file" name="avatar" onchange="getFileName ();" id="uploaded-file-input"><br>
					<div class="avatar-upload-bgc"><p id="uploaded-file">select file</p></div>
					<p id="uploaded-file-warning"></p>
					<input type="submit" value="send">
				</form>
			</div>
			<?else:?>
			<label>log in to view</label>
			<?endif?>
		</div>
	</div>
	<script>
		function getFileName() {
			if(document.getElementById('uploaded-file-input').value!='') {
				if(document.getElementById('uploaded-file-input').value.endsWith('.jpeg') || document.getElementById('uploaded-file-input').value.endsWith('.jpg') || document.getElementById('uploaded-file-input').value.endsWith('.png')) {
					document.getElementById('uploaded-file').innerHTML = document.getElementById('uploaded-file-input').value.replace (/\\/g, '/').split('/').pop();
					document.getElementById('uploaded-file-warning').style.display = 'none';
				}
				else {
					document.getElementById('uploaded-file-input').value = '';
					document.getElementById('uploaded-file').innerHTML = "select file";
					document.getElementById('uploaded-file-warning').style.display = 'block';
					document.getElementById('uploaded-file-warning').innerHTML = '.jpeg, .jpg, .png only'
				}
				
			}
			else {
				document.getElementById('uploaded-file').innerHTML = "select file";
			}
		}

		function emptyCheck() {
			if(document.getElementById('uploaded-file-input').value=='') {
				document.getElementById('uploaded-file-warning').style.display = 'block';
				document.getElementById('uploaded-file-warning').innerHTML = 'file cant be empty';
				return false;
			}
			
		}
	</script>
	<script src="../src/js/dropdown.js"></script>
</body>
</html>