<?php
    session_start();

    $login =  filter_var(trim($_POST["login"]), FILTER_SANITIZE_STRING);
    $password =  filter_var(trim($_POST["password"]), FILTER_SANITIZE_STRING);

    $password = md5($password."mat1ebal");

    if ($_SESSION["csrf"] == $_POST["token"]) {
        require '../db/configDB.php';

        $sql = 'SELECT * FROM accounts WHERE login = :login AND password = :password';

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('login', $login, PDO::PARAM_STR, 128);
        $stmt->bindParam('password', $password, PDO::PARAM_STR, 128);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            setcookie('user', $user['login'], time() + 1440, "/");
            header('Location: /');
        } else {
            echo "The account with $login login was not found.";
        }
    } else {
        die("CSRF error");
    }
?>