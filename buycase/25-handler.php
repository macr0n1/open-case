<?php
    session_start();

    if ($_SESSION["csrf"] == $_POST["token"]) {
        require '../src/configDB.php';

        $login = $_COOKIE['user'];

        $sql = 'SELECT `addicted-case`, `balance` FROM `accounts` WHERE login = :login';
				
		$stmt = $pdo->prepare($sql);
        $stmt->bindParam('login', $login, PDO::PARAM_STR, 128);
		$stmt->execute();
		$current = $stmt->fetch(PDO::FETCH_ASSOC);
        if($current['balance'] >=150) {
            $current['addicted-case']++;
            $current['balance']-=150;
        
            $stmt = $pdo->prepare('UPDATE `accounts` SET `addicted-case` = :case, `balance` = :balance WHERE `login`=:login');
            $stmt->execute(['case' => $current['addicted-case'], 'balance' => $current['balance'], 'login' => $login]);
            header('Location: /');
        }
        else {
            header('Location: /');
        }
    } else {
        die("CSRF error");
    }
?>