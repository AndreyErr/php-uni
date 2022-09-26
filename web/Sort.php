<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>2.Сортировка</title>
    <style>
        body {
            font-size: 24px;
        }
    </style>
</head>

<body>
    <a href="http://localhost:9000/Drawer.php?num=333">Drawer</a>
    <a href="http://localhost:9000">Главная</a>
    <a href="http://localhost:9000/Unix.php">Unix</a>
    <?php

    function selectSort(array $arr){
        $count= count($arr);
        if ($count <= 1){
            return $arr;
        }
        for ($i = 0; $i < $count; $i++){
            $k = $i;
    
            for($j = $i + 1; $j < $count; $j++){
                if ($arr[$k] > $arr[$j]){
                    $k = $j;
                }
    
                if ($k != $i){
                    $tmp = $arr[$i];
                    $arr[$i] = $arr[$k];
                    $arr[$k] = $tmp;
                }
            }
        }
    
        return $arr;
    }

    if(isset($_GET['array'])){
        $array = explode(",", $_GET["array"]);
        echo "<p>Изначальный массив: [" . implode(", ", $array) . "]</p>";
        $array = selectSort($array);
        echo "<p>Отсортированный массив: [" . implode(", ", $array) . "]</p>";
    }else{
        echo '<p>Отсутствует переменная: ?array=</p>';
    }

    ?>
</body>

</html>