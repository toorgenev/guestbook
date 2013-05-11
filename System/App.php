<?php
namespace System
{
    use System\Application as Application;

    /*Singleton class for Application instance*/
    class App
    {
        protected static $instance;
        private function __construct(){}
        private function __clone(){}
        private function __wakeup(){}

        public static function create($configPath){
            if(empty($configPath)){
                $configPath = $_SERVER['DOCUMENT_ROOT'] . '/App/Config/Main.php';
            }

            if(file_exists($configPath)){
                $config = require_once($configPath);
            }else{
                echo 'Can\'t open config file '.var_export($configPath,true);
                die();
            }
            $app = new Application($config);
            self::$instance = $app;
            return $app;
        }

        /*get Application instance or create new one*/
        public static function get(){
            if ( is_null(self::$instance) ) {
                self::create();
            }
            return self::$instance;
        }

    }
}
