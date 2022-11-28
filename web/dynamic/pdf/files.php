<?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT'] ."/standart/header.php";
    require $_SERVER['DOCUMENT_ROOT'] .'/settings.php';
?>
<div>
<form enctype="multipart/form-data" action="/processing/photo.php" method="POST">
    <input name="file" type="file" />
    <input type="submit" value="Отправить" />
</form>
</div>
<h1>Загруженные файлы:</h1>
<?php
$mysqli = openmysqli();
$photo = $mysqli->query("SELECT * FROM photo;");
$mysqli->close();

foreach($photo as $kay){
    echo "<a class='filelink' href='./pdf/" . $kay['name'] . "'>" . $kay['name'] . "</a><br>";
}
?>
<?php
    require $_SERVER['DOCUMENT_ROOT'] ."/standart/footer.php";
?>