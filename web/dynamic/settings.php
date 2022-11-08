<?php

function openmysqli(): mysqli {
    $connection = new mysqli("Mysql_db", "root", "root", "appDB");
    return $connection;
}

function hashGeneration($text){
    return md5($text);
}