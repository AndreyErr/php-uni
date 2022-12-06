<html lang="ru">
<head>
  <title>Пр 5</title>
  <link rel="stylesheet" href="/src/css/style.css" type="text/css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color:#<?php 
if(array_key_exists('theme', $_SESSION))
  if($_SESSION['theme'] == 0)
    echo "F5FFFA";
  else
    echo "778899";

?>;">
<header class="site-header">
    <div class="site-identity">
      <h1><a href="/">Пр 5 <?php if(array_key_exists('name', $_SESSION)){ echo ' | Имя: '.$_SESSION['name'];}?></a></h1>
    </div>  
    <nav class="site-navigation">
      <ul class="nav">
        <li><a href="/">Главная</a></li> 
        <!-- <li><a href="/catalog.php">Каталог</a></li>  -->
        <li><a href="/adm.php">Адм</a></li> 
        <li><a href="/about.html">О нас</a></li> 
        <li><a href="/pdf/files.php">Файлы</a></li>
      </ul>
    </nav>
  </header>