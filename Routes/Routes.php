<?php 
//A partir da URL separa entre classe, função e parametro;
// localhost/cadastro/curso/informatica
//             ^        ^        ^
//           CLasse   Funcão  Parametro
Class Routes{
    public function __construct()
    {    
        $this->run();
    }

    public function run()
    {
        $parameters = NULL;
        
        if(isset($_GET['pag'])) 
        {
            $url = $_GET['pag'];   
        }
        
        if(!empty($url))
        {
            $url = explode('/', $url);
            $controller= $url[0].'Controller'; // classe
            array_shift($url); 

            if(isset($url[0]) && !empty($url[0]))
            { 
                $metod = $url[0];
                array_shift($url);
                
            } else {$metod = 'index'; }
            
            if(count($url)>0){ $parameters = $url; }
            count($url)>0?$parameters = $url:0;
        
        }else { //caso nao seja passado nada na URl
            $controller= "homeController";
            $metod = "homepage";
        }


        $route = '../CONTROLLER'.$controller.'.php';
        //caso seja passado um caminho inexistente
        if(!file_exists($route) && !method_exists($controller, $metod)) 
        {
            $controller= "homeController";
            $metod = "homepage";
        }

        $classe = new $controller;
        $classe->{$metod}($parameters);
    }

}

?>