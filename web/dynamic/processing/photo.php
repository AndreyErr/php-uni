<?php

require $_SERVER['DOCUMENT_ROOT'] .'/settings.php';

if($_FILES['file']){
    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/pdf/pdf/';
            if (!empty($_FILES)) {
                $error = "";
                $fileName = $_FILES['file']['name'];
                $fileSize = $_FILES['file']['size'];
                $fileType = $_FILES['file']['type'];
                $fileFormat = explode('/',$fileType)[1];
                $fileExt = explode('.',$fileName);
                $fileExt = strtolower(end($fileExt));
                $expensions = array("pdf");
                if(array_search($fileFormat, $expensions) === false) {
                    $error = 'Неправильный формат файла'; 
                }elseif ($fileSize == 0) {
                    $error = 'Файл пустой';
                }elseif($fileSize > 2097152){ // Биты
                    $error = 'Файл > 2mb';  
                }
                if($error == ""){
                    $fileTmp = $_FILES['file']['tmp_name'];
                    $name = date("His");
                    $fileName = $name.'.pdf';
                    move_uploaded_file($fileTmp, $uploaddir.$fileName);
                    $mysqli = openmysqli();
                    $mysqli->query("INSERT INTO photo VALUES (NULL, '".$fileName."');");
                    $mysqli->close();
                    header('Location: ' .'/pdf/files.php');
                }else{
                    echo $error;
                }
            }else
                echo "Нет файлов";
}