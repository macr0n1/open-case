<?php
    session_start();

    $login = filter_var(trim($_POST["login"]), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

    $password = md5($password."mat1ebal");

    if ($_SESSION["csrf"] == $_POST["token"]) {
        require '../src/configDB.php';
        $stmt = $pdo->prepare('INSERT INTO accounts(login, password) VALUES(:login, :password)');
        $stmt->execute(['login' => $login, 'password' => $password]);
        header('Location: /login');
    } else {
        die("CSRF error");
    }

?>