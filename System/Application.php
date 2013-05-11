<?php
namespace System
{
    use PDO as PDO,
        PDOException as PDOException,
        Exception as Exception;

    class Application
    {
        public $db;
        public $controller;
        public $config;
        public $basePath;

        /*Create application instance, initialize DB conponent, accept some configs*/
        public function __construct($config){
            $this->config = $config;
            $this->basePath = dirname(__DIR__);
            
            if(!empty($config['db'])){
                try{
                    $this->db = new PDO( $config['db']['connectionString'], $config['db']['user'], $config['db']['pass'], array(PDO::ATTR_PERSISTENT => true ));
                } catch (PDOException $e) {
                    echo "Error PDO: " . $e->getMessage();
                    die();
                }
            }
        }

        /*route application flow to controller/action based or request string*/
        public function run(){
            $uri = $_SERVER['REQUEST_URI'];
            if(($pos=strpos($uri,'?'))!==false){
                $uri=substr($uri,0,$pos);
            }
            $uri = trim($uri, '/ ');

            $route = !empty($uri) ? $uri : $this->config['defaultRoute'];
            list($controllerName,$actionName) = explode('/',"$route/");
            if(empty($actionName)) $actionName = 'index';

            try{
                $controllerClass = 'App\\Controllers\\' . ucfirst(strtolower($controllerName)) . 'Controller';
                $controller = new $controllerClass;
            } catch(Exception $e) {
                echo 'Can\'t find controller: '.var_export($controllerName,true);
                die();
            }

            $this->controller = $controller;

            $actionMethod = 'action' . ucfirst(strtolower($actionName));
            if(method_exists($controller,$actionMethod)){
                $controller->$actionMethod();                
            }else{
                echo 'Can\'t run action: '.var_export($route,true);
                die();                
            }

            return true;
        }
    }
}
