<?php
    require_once "standart/header.php";
    require_once 'settings.php';
?>
<h1>ADM1 | Пользователи</h1>
<table>
    <tr><th>ID</th><th>Логин</th><th>Пароль</th></tr>
<?php
$mysqli = openmysqli();
$result = $mysqli->query("SELECT * FROM user ORDER BY id DESC");
foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['pass']}</td></tr>";
}
?>
</table>

<form action="processing/login.php" method="POST">
<p><input type="submit" value="Выход" name="exit"></p>
</form>

<?php
    require_once "standart/footer.php";
?>