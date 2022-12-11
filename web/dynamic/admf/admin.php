<?php
if(!array_key_exists('id', $_SESSION))
    header('Location: ' . '../');
?>
<h1>ADM1 | Пользователи</h1>
<h1>Сессия id: <?php echo $_SESSION['id']?></h1>
<table>
    <tr><th>ID</th><th>Логин</th><th>Пароль</th></tr>
<?php
foreach ($data['users'] as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['pass']}</td></tr>";
}
?>
</table>

<form action="a/unLogin" method="POST">
<p><input type="submit" value="Выход" name="exit"></p>
</form>