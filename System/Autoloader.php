<?php
namespace System
{
    /*Autoloader class for load required files based on Namespace*/
    class Autoloader
    {
        public static function autoload($file)
        {
            $file = str_replace('\\', '/', $file);
            $path = $_SERVER['DOCUMENT_ROOT'];
            $filepath = $path. '/' . $file . '.php';

            if (file_exists($filepath)){
                require_once($filepath);
            }else{ 
                echo('Can\'t find class '.var_export($file,true));
                die();
            }
        }
    }

    spl_autoload_register('System\Autoloader::autoload');
}
