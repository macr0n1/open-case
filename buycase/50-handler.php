<?php
    session_start();

    if ($_SESSION["csrf"] == $_POST["token"]) {
        require '../src/configDB.php';

        $sql = 'SELECT `persist-case`, `balance` FROM `accounts` WHERE login = :login';
				
		$stmt = $pdo->prepare($sql);
        $stmt->bindParam('login', $_COOKIE['user'], PDO::PARAM_STR, 128);
		$stmt->execute();
		$current = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($current['balance'] >=250) {
            $current['persist-case']++;
            $current['balance']-=250;
        
            $stmt = $pdo->prepare('UPDATE `accounts` SET `persist-case` = :case, `balance` = :balance WHERE `login`=:login');
            $stmt->execute(['case' => $current['persist-case'], 'balance' => $current['balance'], 'login' => $_COOKIE['user']]);
            header('Location: /');
        }
        else {
            header('Location: /');
        }
    } else {
        die("CSRF error");
    }
?>