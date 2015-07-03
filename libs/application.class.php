<?php

/**
 * Class Application
 * The heart of the app
 */
class application {

    /** @var null The module part of the URL */
    private $url_module;

    /** @var null The controller part of the URL */
    private $url_controller;

    /** @var null The method part (of the above controller) of the URL */
    private $url_action;

    /** @var null Parameter one of the URL */
    private $url_parameter_1;

    /** @var null Parameter two of the URL */
    private $url_parameter_2;

    /** @var null Parameter three of the URL */
    private $url_parameter_3;

    /**
     * Starts the Application
     * Takes the parts of the URL and loads the according controller & method and passes the parameter arguments to it
     * TODO: get rid of deep if/else nesting
     * TODO: make the hardcoded locations ("error/index", "index.php", new Index()) dynamic, maybe via config.php
     */
    public function __construct() {
        $this->splitUrl();
        //check for module : is the module NOT empty? backoffice or reservation
        if ($this->url_module) {
            // check for controller: is the url_controller NOT empty ?    
            if ($this->url_controller) {
                // check for controller: does such a controller exist ?

                if (file_exists(DOC_PATH . $this->url_module . "/" . CONTROLLER_PATH . "/" . $this->url_controller . "/controller_" . $this->url_controller . '.class.php')) {
                    // if so, then load this file and create this controller
                    // example: if controller would be "car", then this line would translate into: $this->car = new car();
                    require DOC_PATH . $this->url_module . "/" . CONTROLLER_PATH . "/" . $this->url_controller . "/controller_" . $this->url_controller . '.class.php';
                    $this->url_controller = new $this->url_controller($this->url_module);

                    // check for method: does such a method exist in the controller ?
                    if ($this->url_action) {
                        if (method_exists($this->url_controller, $this->url_action)) {

                            // call the method and pass the arguments to it
                            if (isset($this->url_parameter_3)) {
                                $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
                            } elseif (isset($this->url_parameter_2)) {
                                $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                            } elseif (isset($this->url_parameter_1)) {
                                $this->url_controller->{$this->url_action}($this->url_parameter_1);
                            } else {
                                // if no parameters given, just call the method without arguments
                                $this->url_controller->{$this->url_action}();
                            }
                        } else {
                            // redirect user to error page (there's a controller for that)
                            // header('location: ' . URL . 'error/index');
                            echo "No function";
                        }
                    } else {
                        // default/fallback: call the index() method of a selected controller
                        $this->url_controller->index();
                    }
                    // obviously mistyped controller name, therefore show 404
                } else {
                    // redirect user to error page (there's a controller for that)
                    // header('location: ' . URL . 'error/index');
                    echo "No class";
                }
                // if url_controller is empty, simply show the main page (index/index)
            } else {
                // invalid URL, so simply show home/index

                if (file_exists(DOC_PATH . $this->url_module . "/" . CONTROLLER_PATH . 'index/controller_index.class.php')) {
                    require DOC_PATH . $this->url_module . "/" . CONTROLLER_PATH . 'index/controller_index.class.php';
                    $controller = new index($this->url_module);
                    $controller->index();
                } else {
                    //header('location: ' . URL . 'error/index');  
                    echo"file not exisr";
                }
            }
        } else {
            
        }
    }

    /**
     * Gets and splits the URL
     */
    private function splitUrl() {
        if (isset($_GET['url'])) {
            // split URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            // Put URL parts into according properties
            // By the way, the syntax here if just a short form of if/else, called "Ternary Operators"
            // http://davidwalsh.name/php-shorthand-if-else-ternary-operators

            $this->url_module = (isset($url[0]) ? $url[0] : '');
            $this->url_controller = (isset($url[1]) ? $url[1] : '');
            $this->url_action = (isset($url[2]) ? $url[2] : '');
            $this->url_parameter_1 = (isset($url[3]) ? $url[3] : '');
            $this->url_parameter_2 = (isset($url[4]) ? $url[4] : '');
            $this->url_parameter_3 = (isset($url[5]) ? $url[5] : '');
            /*
             * Set defaul
             */
            if (empty($this->url_module)) {
                 header('location: ' . URL . 'template'); 
            } else if ($this->url_module == 'admin') {
                if (empty($this->url_controller)) {
                    $this->url_controller = 'dashbord';
                }
            }
        }
    }

}
