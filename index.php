<?php
    use System\App as App;

    /*use Autoloader class for autoinclude files for namespaces*/
    require_once dirname(__FILE__).'/System/Autoloader.php';

    /*path to application config file*/
    $config = dirname(__FILE__).'/App/Config/Main.php';

    /*construct new application with app config and run them*/
    App::create($config)->run();
