<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>3.Команды</title>
    <style>
        body {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <a href="http://localhost:9000/Drawer.php?num=333">Drawer</a>
    <a href="http://localhost:9000/Sort.php?array=6,8,1,2,5,1,3,5,4,7,9,4">Sort</a>
    <a href="http://localhost:9000">Главная</a>
    <?php
    $command_list = array('ls .', 'ps', 'whoami', 'id', 'cat Dockerfile', 'uname', 'date');
    foreach ($command_list as $cmd) {
        print_cmd($cmd);
    }

    // Запуск и вывод команды
    function print_cmd($cmd){
        $lines = array();
        exec($cmd, $lines);
        echo "<p>///> " . $cmd . "</p>";
        echo "<pre>" . implode("\n", $lines) . "</pre>";
    }
    ?>
</body>

</html>