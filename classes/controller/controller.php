<?php 

namespace controller;

class Controller{

    protected array $params;

    public function __construct(array $params = []){
        $this->params = $params;
    }

    /**
     * affiche une vue
     * @param string $view
     * @param array $variale
     */
    public function render(string $view, array $variable = []){
        // converti le tableau en variable
        extract($variable);
        require "view/".$view;
    }

    /**
     * @param string $controller nom du controller
     * @param string $action méthode à appeller 
     */
    public function redirect(string $controller, string $action): void{
        $url = "index.php?controller=".$controller."&action=".$action;
        header("Location: ".$url);
        exit;
    }
}