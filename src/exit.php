<?php
    setcookie('user', $user['login'], time() - 9999, "/");
    header('Location: /');
?>