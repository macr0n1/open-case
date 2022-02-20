<?php
    session_start();
    
    if ($_SESSION["csrf"] == $_POST["token"]) {
        $avatar = $_FILES['avatar'];
        if($avatar['size']<15000000) {
            require '../src/configDB.php';
            $avatarName = md5(microtime(true)) . '.png';
            $puthFile = __DIR__ . "/../src/img/avatars/" . $avatarName;
            move_uploaded_file($avatar['tmp_name'], $puthFile);
            $stmt = $pdo->prepare('UPDATE `accounts` SET `avatar` = :avatar WHERE `login`=:login');
            $stmt->execute(['avatar' => $avatarName, 'login' => $_COOKIE['user']]);
            header('Location: /settings');
        }
    } else {
        die("CSRF error");
    }

?>