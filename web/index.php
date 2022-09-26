<html lang="en">
<head>
<title>Hello world 11211211</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
    <a href="http://localhost:9000/Drawer.php?num=333">Drawer</a>
    <a href="http://localhost:9000/Sort.php?array=6,8,1,2,5,1,3,5,4,7,9,4">Sort</a>
    <a href="http://localhost:9000/Unix.php">Unix</a>
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
<?php
phpinfo();
?>
</body>
</html>