<?php
session_start();
require '../settings.php';

// Если кнопка нажата, то выполняет вход
if (isset($_POST['done'])) {

    $name = htmlspecialchars($_POST['login']);
    $password = md5(htmlspecialchars($_POST['pass']));
    $mysqli = openmysqli();
    // Подготовка и отправка запроса
    $statement = $mysqli->query('SELECT * FROM user WHERE name = "'.$name.'" AND pass = "'.$password.'";');
    // Есть в списке пользователей
    $mysqli->close();
    if ($statement != false && $statement->num_rows == 1) {
        $result = mysqli_fetch_assoc($statement);
        $_SESSION['id'] = $result['id'];
        $_SESSION['theme'] = $result['theme'];
        $_SESSION['name'] = $result['name'];
        header('Location: ' . '../adm.php');
    } else {
        header('Location: ' . '../index.php?err=1');
    }
}

// Если кнопка нажата, то выполняет выход
if (isset($_POST['exit'])) {
    session_destroy();
    header('Location: ' . '../index.php?ext=1');
}
