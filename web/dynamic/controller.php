<?php
    session_start();
    require_once 'settings.php';
    
    $app = new controller;
    class controller{

        protected $path; // Путь, разбитый на массив
        protected $model; // Объект модели
        protected $view; // Объект представления
        public function __construct(){
            // Подключение модели и представления
            $path = explode('/', trim($_SERVER['REDIRECT_URL'], '/'));
            if ($path[0] == "")
                $path[0] = $page = "main";
            require_once($_SERVER['DOCUMENT_ROOT'].'/model.php'); // Задание пути к модели
            require_once($_SERVER['DOCUMENT_ROOT'].'/view.php'); // Задание пути к представлению
            $model = 'model';
            $view = 'view';
            $this->path = $path;
            $this->model = new $model;
            $this->view = new $view;
            $this->pageSelect();
        }
    
        // Выбор страницы
        private function pageSelect(){
            if($this->path[0] == 'a' && array_key_exists(1,$this->path)){
                $action = $this->path[1];
                $this->model->$action();
            }elseif($this->path[0] == 'main'){
                $this->mainPage();
            }elseif($this->path[0] == 'magaz'){
                $this->catalogPage();
            }elseif($this->path[0] == 'admin'){
                $this->adminPage();
            }elseif($this->path[0] == 'files'){
                $this->filesPage();
            }
        }
    
        private function mainPage(){
        $usersOne = $this->model->selectUsersOne();
            $dataToView = array(
                "usersOne" => $usersOne
            );
            $this->view->rander('mainf/main', $dataToView);
        }

        private function catalogPage(){
            $prodicts = $this->model->selectProdicts();
            $dataToView = array(
                "prodicts" => $prodicts
            );
            $this->view->rander('catal/magaz', $dataToView, 'Каталог');
        }

        private function adminPage(){
            $users = $this->model->selectUsers();
            $dataToView = array(
                "users" => $users
            );
            $this->view->rander('admf/admin', $dataToView, 'Админ панель');
        }

        private function filesPage(){
            $files = $this->model->selectFiles();
            $dataToView = array(
                "files" => $files
            );
            $this->view->rander('pdf/files', $dataToView, 'Файлы');
        }
    
    
    }

?>
