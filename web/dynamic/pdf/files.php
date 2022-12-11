<div>
<form enctype="multipart/form-data" action="/a/photoAdd" method="POST">
    <input name="file" type="file" />
    <input type="submit" value="Отправить" />
</form>
</div>
<h1>Загруженные файлы:</h1>
<?php
foreach($data['files'] as $kay){
    echo "<a class='filelink' href='/pdf/pdf/" . $kay['name'] . "'>" . $kay['name'] . "</a><br>";
}
?>