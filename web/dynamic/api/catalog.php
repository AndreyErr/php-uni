<?php 
require_once '../settings.php';
require_once '../processing/api_proc.php';

// 200, 201 - успех
// 400 - неудача
// 406 - несуществующий запрос

$data = json_decode(file_get_contents('php://input'), true);
if($_SERVER['REQUEST_METHOD'] == 'POST' && $data['type'] == 'addunit'){
    if(!isset($data['name']) || !isset($data['typeofdev']) || !isset($data['cost']) || $data['name'] == '' || $data['typeofdev'] == '' || $data['cost'] == '') {
        output(400, 'Invalid arguments (must be a name, typeofdev, cost)');
    }else{
        $mysqli = openMysqli();
        $unitName = $mysqli->real_escape_string($data['name']);
        $unitType = $mysqli->real_escape_string($data['typeofdev']);
        $unitCost = $data['cost'];
        $result = $mysqli->query("SELECT id FROM product WHERE name = '$unitName'");
        if($result->num_rows === 1)
            output(400, 'Product '.$unitName.' already exists');
        elseif(!is_numeric($unitCost) || $unitCost < 0)
            output(400, 'Cost must be a number and >= 0');
        else{
            $mysqli->query("INSERT INTO product VALUES (NULL, '$unitName', '$unitType', '$unitCost', 0);");
            output(201, 'Added product '.$unitName.' with type '.$unitType.' and cost '.$unitCost);
        }
        $mysqli->close();
    }
}


elseif($_SERVER['REQUEST_METHOD'] == 'DELETE' && $data['type'] == 'deleteunit'){
    if(!isset($data['name']) || $data['name'] == '') {
        output(400, 'Invalid arguments (must be a name)');
    }else{
        $mysqli = openMysqli();
        $unitName = $mysqli->real_escape_string($data['name']);
        $result = $mysqli->query("SELECT * FROM product WHERE name = '$unitName'");
        if($result->num_rows === 0)
            output(400, 'Product '.$unitName.' does not exist');
        else{
            $mysqli->query("DELETE FROM product WHERE name = '$unitName'");
            output(201, 'Deleted Product '.$unitName);
        }
        $mysqli->close();
    }
}


elseif($_SERVER['REQUEST_METHOD'] == 'PATCH' && $data['type'] == 'changeprice'){
    if(!isset($data['name']) || !isset($data['newprice']) || $data['name'] == '' || $data['newprice'] == '') {
        output(400, 'Invalid arguments (must be a name, newprice)');
    }else{
        $mysqli = openMysqli();
        $unitName = $mysqli->real_escape_string($data['name']);
        $newPrice = $mysqli->real_escape_string($data['newprice']);
        $oldUserCheck = $mysqli->query("SELECT 'id' FROM product WHERE name = '$unitName'");
        if($oldUserCheck->num_rows === 0)
            output(400, 'Product '.$unitName.' does not exist');
        elseif(!is_numeric($newPrice) || $newPrice < 0)
            output(400, 'Newprice must be a number and >= 0');
        else{
            $mysqli->query("UPDATE product SET cost = '$newPrice' WHERE name = '$unitName'");
            output(201, 'Changed the price of '.$unitName.' to '.$newPrice);
        }
        $mysqli->close();
    }
}


elseif($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['type'] == 'getunitbyid'){
    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        output(400, 'Invalid arguments (must be id)');
    }else{
        $mysqli = openMysqli();
        $unitId = $mysqli->real_escape_string($_GET['id']);
        $result = $mysqli->query("SELECT * FROM product WHERE id = '$unitId'");
        $resultarr = $result->fetch_assoc();
        if($result->num_rows === 0)
            output(400, 'ID '.$unitId.' does not exist');
        else{
            output(200, 'id: '.$resultarr['id'].', name: '.$resultarr['name'].', type: '.$resultarr['type'].', cost: '.$resultarr['cost'].', img: http://localhost:9000/src/img/market/'.$resultarr['img'].'.png');
        }
        $mysqli->close();
    }
}


else{
    output(406, 'Invalid mode');
}