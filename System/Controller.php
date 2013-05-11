<?php
namespace System
{
    class Controller
    {
        public $layout = 'main';

        /*Function for render views. Find reqired view in ./App/Views/%ControllerName% 
         * folder and include them, with PHP OutputBuffer component
         * 
         * $useLayout param is true - View file content is putted into Layout file content
         * $params - array, which extracted to variabler before rendering
         */
        public function render($viewName, $useLayout = true, $params = array()){
            $classNameWithNS = get_class($this);
            $className = end(explode('\\',$classNameWithNS));
            $controllerName = substr($className,0,strpos($className, 'Controller'));

            $viewPath = App::get()->basePath .
                        '/App/Views/' . $controllerName .
                        '/' . strtolower($viewName) . '.php';
            if(!file_exists($viewPath)){
                echo 'Can\'t find view file';
                die();
            }

            $view = $this->_renderFile($viewPath, $params);

            if($useLayout){
                $layoutPath = App::get()->basePath . '/App/Views/Layout/' . $this->layout . '.php';
                if(!file_exists($layoutPath)){
                    echo 'Can\'t find layout file';
                    die();
                }
                $layout = $this->_renderFile($layoutPath, array('content'=>$view));
            }

            if($useLayout){
                $content = $layout;
            }else{
                $content = $view;
            }
            return $content;
        }

        private function _renderFile($path,$params = array()){
            ob_start();
            ob_implicit_flush(false);
            extract($params);
            require($path);
            return ob_get_clean();
        }
    }
}
