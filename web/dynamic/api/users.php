<?php 
require_once '../settings.php';
require_once '../processing/api_proc.php';

// 200, 201 - успех
// 400 - неудача
// 406 - несуществующий запрос

$data = json_decode(file_get_contents('php://input'), true);
if($_SERVER['REQUEST_METHOD'] == 'POST' && $data['type'] == 'adduser'){
    if(!isset($data['name']) || !isset($data['pass']) || $data['name'] == '' || $data['pass'] == '') {
        output(400, 'Invalid arguments (must be a name, password)');
    }else{
        $mysqli = openMysqli();
        $usrName = $mysqli->real_escape_string($data['name']);
        $usrPass = hashGeneration($data['pass']);
        $result = $mysqli->query("SELECT id FROM user WHERE name = '$usrName'");
        if($result->num_rows === 1)
            output(400, 'User '.$usrName.' already exists');
        else{
            $mysqli->query("INSERT INTO user VALUES (NULL, '$usrName', '$usrPass');");
            output(201, 'Added user '.$usrName);
        }
        $mysqli->close();
    }
}


elseif($_SERVER['REQUEST_METHOD'] == 'DELETE' && $data['type'] == 'deleteuser'){
    if(!isset($data['name']) || !isset($data['pass']) || $data['name'] == '') {
        output(400, 'Invalid arguments (must be a name, password)');
    }else{
        $mysqli = openMysqli();
        $usrName = $mysqli->real_escape_string($data['name']);
        $usrPass = hashGeneration($data['pass']);
        $result = $mysqli->query("SELECT * FROM user WHERE name = '$usrName'");
        $resultarr = $result->fetch_assoc();
        if($result->num_rows === 0)
            output(400, 'User '.$usrName.' does not exist');
        elseif($usrPass != $resultarr['pass'])
            output(400, 'Invalid password');
        else{
            $mysqli->query("DELETE FROM user WHERE name = '$usrName' and pass = '$usrPass'");
            output(201, 'Deleted user '.$usrName);
        }
        $mysqli->close();
    }
}


elseif($_SERVER['REQUEST_METHOD'] == 'PATCH' && $data['type'] == 'chusername'){
    if(!isset($data['name']) || !isset($data['newname']) || !isset($data['pass']) || $data['name'] == '' || $data['newname'] == '') {
        output(400, 'Invalid arguments (must be a name, newname, password)');
    }else{
        $mysqli = openMysqli();
        $usrName = $mysqli->real_escape_string($data['name']);
        $usrNewName = $mysqli->real_escape_string($data['newname']);
        $usrPass = hashGeneration($data['pass']);
        $oldUserCheck = $mysqli->query("SELECT * FROM user WHERE name = '$usrName'");
        $newUserCheck = $mysqli->query("SELECT 'id' FROM user WHERE name = '$usrNewName'");
        $resultOldarr = $oldUserCheck->fetch_assoc();
        if($oldUserCheck->num_rows === 0)
            output(400, 'User '.$usrName.' does not exist');
        elseif($newUserCheck->num_rows === 1)
            output(400, 'User '.$usrNewName.' already exists');
        elseif($usrPass != $resultOldarr['pass'])
            output(400, 'Invalid password');
        else{
            $mysqli->query("UPDATE user SET name = '$usrNewName' WHERE name = '$usrName' and pass = '$usrPass'");
            output(201, 'Changed the name '.$usrName.' to the name '.$usrNewName);
        }
        $mysqli->close();
    }
}


elseif($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['type'] == 'getuserid'){
    if(!isset($_GET['name']) || $_GET['name'] == '') {
        output(400, 'Invalid arguments (must be a name)');
    }else{
        $mysqli = openMysqli();
        $usrName = $mysqli->real_escape_string($_GET['name']);
        $result = $mysqli->query("SELECT id FROM user WHERE name = '$usrName'");
        $resultarr = $result->fetch_assoc();
        if($result->num_rows === 0)
            output(400, 'User '.$usrName.' does not exist');
        else{
            output(200, $resultarr['id']);
        }
        $mysqli->close();
    }
}


else{
    output(406, 'Invalid mode');
}