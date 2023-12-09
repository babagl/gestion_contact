<?php
// require "../Controller/TotoCtrl.php";
// require "../Controller/HomeCtrl.php";
// require "../Controller/KadiaCtrl.php";


class Router
{

    public function __construct()
    {
        $uri = $_SERVER["REQUEST_URI"];
       
            $uri =  $uri[-1] == "/" ? substr($uri, 1,-1) : substr($uri, 1) ;
        
       

        $link = explode("/", $uri);
        // var_dump($link);
        if (file_exists("../Controllers/" . ucfirst(strtolower($link[0])) . "Ctrl.php")) {
            // Pour verifier si l'utilisateur à saisi une url; S c'est pas le cas , alors on doit le rediriger vers le controller home;
            if (isset($link[0]) && $link[0]) {
                // echo "controleur existe";
            } else {
                // echo "pas de controleur ";
                $link[0] = "Home";
            }
            //tester si l'action existe;
            if (isset($link[1]) && $link[1]) {
                // echo "action present ";
                require "../Controllers/" . ucfirst(strtolower($link[0])) . "Ctrl.php";
                $controller = ucfirst(strtolower($link[0])) . "Ctrl";
                //Pour instancier le controleur que l'utilisateur souhaite utiliser
                $currentController = new $controller;
                $val = method_exists($currentController,  $link[1]);
                if ($val) {
                    // echo "methode existe";
                    //Pour appeler une methode dans une classe dynamiquement
                    call_user_func([$currentController, $link[1]]);
                } else {
                    echo "404";
                }
            } else {
                echo "404";
            }
        } else {
            echo "page 404";
        }

    }
}