<?php

require_once '../settings.php';

// Если кнопка нажата, то выполняет тело условия
//var_dump($_POST['login']);
//var_dump($_POST['pass']);
if (isset($_POST['done'])) {

    $name = $_POST['login'];
    $password = md5($_POST['pass']);
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
        setcookie('auth', strval(rand(0, 9)));
        header('Location: ' . '../adm.php');
    } else {
        header('Location: ' . '../index.php?e=1');
    }
    }
