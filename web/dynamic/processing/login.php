<?php

require_once '../settings.php';

// Если кнопка нажата, то выполняет вход
if (isset($_POST['done'])) {

    $name = htmlspecialchars($_POST['login']);
    $password = md5(htmlspecialchars($_POST['pass']));
    $mysqli = openmysqli();
    // Подготовка и отправка запроса
    $statement = $mysqli->prepare(
        'SELECT id FROM user WHERE name = ? AND pass = ?'
    );
    $statement->bind_param('ss', $name, $password);
    $statement->execute();
    // Есть в списке пользователей
    $result = $statement->get_result()->num_rows === 1;
    $mysqli->close();

    if ($result) {
        setcookie('auth', "0", time()+60*60, "/");
        header('Location: ' . '../adm.php');
    } else {
        header('Location: ' . '../index.php?err=1');
    }
}

// Если кнопка нажата, то выполняет выход
if (isset($_POST['exit'])) {
    setcookie('auth', "0", time(), "/");
    header('Location: ' . '../index.php?ext=1');
}
