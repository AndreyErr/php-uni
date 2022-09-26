<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>1.Фигуры</title>
</head>
<body onload="runner()">
    <style>
        svg>rect,
        svg>polygon,
        svg>circle {
            stroke: black;
            stroke-width: 1px;
        }

        body {
            font-size: 24px;
        }

        svg {
            height: 500px;
            width: 500px;
        }
    </style>
    <?php
    if(isset($_GET['num'])) {
        $num = $_GET['num']; // Получение переменной
        if(!$num[0] or !$num[1] or !$num[2]){
            echo "Отсутствуют необходимые параметры";
        }else{
            $shape = $num[0]; // 1-Квадрат 2-прямоугольник 3-круг 4-треуг
            $color = '"#' // 1-белый 2-синий 3-красный 4-жёлтый 5-зелёный
                . ($num[1] == 1 ? 'FAF0E6' : "")
                . ($num[1] == 2 ? '0000FF' : "")
                . ($num[1] == 3 ? 'FF0000' : "")
                . ($num[1] == 4 ? 'FFFF00' : "")
                . ($num[1] == 5 ? '00FF00' : "") . '"';
            if($num[2] > 4 or $num[2] < 1){
                echo "Размер за допустимыми рамками! Установленный размер: 2";
                $num[2] = 2;
            }
            $size = $num[2] * 100; // 1-мал 2-сред 3-бол
            $shape_tag = '';
            switch($shape) {
                case 1: // Квадрат
                    $shape_tag = "rect width=" . ($size) . " height=" . ($size);
                    break;
                case 2: // Прямоугольник
                    $shape_tag = "rect width=" . ($size * 2) . " height=" . ($size);
                    break;
                case 3: // Круг
                    $radius = ($size / 2);
                    $shape_tag = "circle cx=" . ($radius + 10) . " cy=" . ($radius + 10) . " r=" . $radius . " ";
                    break;
                case 4: // Треугольник
                    $shape_tag = "polygon points='" . ($size / 2 + 5) . ",10 10," . ($size) . " " . ($size) . "," . ($size) . "'";
                    break;
                default:
                    echo "Неверный ввод формы";
                    break;
            }
            echo '<svg>';
            echo '<' . $shape_tag . ' fill=' . $color . '  />';
            echo '</svg>';
        }
    }else{
        echo '<p>Отсутствует переменная: ?num=</p>';
    }
    ?>
    <a href="http://localhost:9000">Главная</a>
    <a href="http://localhost:9000/Sort.php?array=6,8,1,2,5,1,3,5,4,7,9,4">Sort</a>
    <a href="http://localhost:9000/Unix.php">Unix</a>
</body>

</html>