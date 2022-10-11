<?php
    require_once "standart/header.php";
    require_once 'settings.php';
?>
<h1>Пользователи</h1>
<table>
    <tr><th>ID</th><th>Логин</th><th>Пароль</th></tr>
<?php
$mysqli = openmysqli();
$result = $mysqli->query("SELECT * FROM user");
foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['pass']}</td></tr>";
}
?>
</table>

<?php
    require_once "standart/footer.php";
?>