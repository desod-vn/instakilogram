<?php
    class App 
    {
        const CONTROLLER_FOLDER_NAME = './src/controllers';

        protected $controller = 'Home';
        protected $action = 'index';
        protected $params = [];


        public function __construct()
        {
            $routers = $this->router();

            if (isset($routers[0]) && file_exists(self::CONTROLLER_FOLDER_NAME . "/" . $routers[0] ."Controller.php")) {
                $this->controller = ucfirst($routers[0]);
                unset($routers[0]);
            }

            require_once self::CONTROLLER_FOLDER_NAME . "/" . $this->controller ."Controller.php";
            
            // controller
            $this->controller = new $this->controller;

            if (isset($routers[1])) {
                if( method_exists($this->controller, $routers[1]) )
                    // action
                    $this->action = $routers[1];

                unset($routers[1]);
            }
            
            // params
            $this->params = $routers ? array_values($routers) : [];

            call_user_func_array([$this->controller, $this->action], $this->params);
        }

        function router()
        {
            if (isset($_GET["page"])) {
                $router = explode("/", filter_var(trim(strtolower($_GET["page"]))));

                return $router;
            }
        }

    }