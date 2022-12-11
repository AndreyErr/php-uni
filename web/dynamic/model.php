<?php

class model{
    
    public function selectUsersOne(){
        $mysqli = openmysqli();
        $result = $mysqli->query("SELECT * FROM users");
        $mysqli->close(); 
        return $result;
    }
    public function selectUsers(){
        $mysqli = openmysqli();
        $result = $mysqli->query("SELECT * FROM user");
        $mysqli->close(); 
        return $result;
    }

    public function login(){
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
                header('Location: ' . '../admin');
            } else {
                header('Location: ' . '/');
            }
        }
    }
    public function unLogin(){
        if (isset($_POST['exit'])) {
            session_destroy();
            header('Location: ' . '/');
        }
    }

    public function selectProdicts(){
        $mysqli = openmysqli();
        $result = $mysqli->query("SELECT * FROM product");
        $mysqli->close(); 
        return $result;
    }

    public function selectFiles(){
        $mysqli = openmysqli();
        $result = $mysqli->query("SELECT * FROM photo;");
        $mysqli->close(); 
        return $result;
    }

    public function photoAdd(){
        if($_FILES['file']){
            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/pdf/pdf/';
                if (!empty($_FILES) && $_FILES['file']['name'] != "") {
                    $error = "";
                    $fileName = $_FILES['file']['name'];
                    $fileSize = $_FILES['file']['size'];
                    $fileType = $_FILES['file']['type'];
                    $fileExt = explode('.',$fileName);
                    $fileExt = strtolower(end($fileExt));
                    $expensions = array("pdf");
                    if(array_search($fileExt, $expensions) === false) {
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
        
                        exec('file ' . $uploaddir.$fileName, $fileExt);
                        $isPdf = strripos($fileExt[0], 'pdf document');
                        if ($isPdf != false){
                            $mysqli = openmysqli();
                            $mysqli->query("INSERT INTO photo VALUES (NULL, '".$fileName."');");
                            $mysqli->close();
                            header('Location: ' .'/files');
                        } else {
                            exec('rm ' . $uploaddir . $fileName, $fileExt);
                            echo 'Неправильный формат файла';
                        }
                    }else{
                        echo $error;
                    }
                }else
                    echo "Нет файлов";
        }else
            header('Location: ' .'/files');
    }

}