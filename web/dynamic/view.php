<?php

class view{
    // Рендер нужного вида 
    public function rander($path, $data = [], $name = 'Пр 7'){ // Путь к виду, данные, доп вид (не обяз)
        $path = $_SERVER['DOCUMENT_ROOT'].'/'.$path.'.php';
        if (file_exists($path)){
            ob_start();
            require $path;
            $content = ob_get_clean();
            $content = $this->randLayouts($content, $data, $name);
            echo $content;
        }else
            header('Location: /main');
        exit;
    }

    // Рендер доп контента (шипки и подвала)
    private function randLayouts($content, $data, $name){
        $path = $_SERVER['DOCUMENT_ROOT'].'/layouts/headerFooter.php';
        if (file_exists($path)){
            ob_start();
            require $path;
            return ob_get_clean();
        }else
            header('Location: /err/error.html');
    }
}