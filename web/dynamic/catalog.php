<?php
    require_once "standart/header.php";
    require_once 'settings.php';
?>
<h1>Каталог продуктов</h1>
<table>
    <tr><th>Название</th><th>Тип</th><th>Цена</th><th>Изображение</th></tr>
<?php
$mysqli = openmysqli();
$result = $mysqli->query("SELECT * FROM product");
foreach ($result as $row){
    echo "<tr><td>{".$row['name']."}</td><td>{".$row['type']."}</td><td>{".$row['cost']."}</td><td><img src='/src/img/market/{".$row['img']."}.png' height='100px' alt='{".$row['cost']."}'></td></tr>";
}
?>
</table>

<?php
    require_once "standart/footer.php";
?>