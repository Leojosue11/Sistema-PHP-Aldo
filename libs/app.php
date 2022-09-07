<?php
require_once 'controllers/errores.php';
class App
{

    function __construct()
    {
        // Si no encuetra ningun controlador siempre se ira al login
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        // Obtiene la url
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        // Revisa si no hay controlador especificado manda al login
        if (empty($url[0])) {
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            // $controller = new Login();
            // $controller->loadModel('login');
            // $controller->render();
            return false;
        }


        $archivoController = 'controllers/' . $url[0] . '.php';

        if (file_exists($archivoController)) {
            require_once $archivoController;

            // inicializar controlador            
            $controller = new $url[0];
            $controller->LoadModel($url[0]);

            if (isset($url[1])) {
                // Manda a llamar al metodo si es lo hay
                $controller->{$url[1]}();
            }
        } else {
            // $controller = new Errores();
        }
    }
}
