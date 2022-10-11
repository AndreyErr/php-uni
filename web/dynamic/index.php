<?php
    require_once "standart/header.php";
?>

<h1>Таблица пользователей данного продукта</h1>
<table>
    <tr><th>Id</th><th>Name</th><th>Surname</th></tr>
<?php
$mysqli = new mysqli("Mysql_db", "root", "root", "appDB");
$result = $mysqli->query("SELECT * FROM users");
foreach ($result as $row){
    echo "<tr><td>{$row['ID']}</td><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
}
?>
</table>
<script>
      if (get('e')) {
        alert("Неверный логин или пароль");
      };
    </script>
<form action="processing/login.php" method="POST">
<p>Введите логин: <input type="text" name="login"></p>
<p>Введите пароль: <input type="password" name="pass"></p>
<p><input type="submit" value="Войти" name="done"></p>
</form>
<?php
    require_once "standart/footer.php";
?>