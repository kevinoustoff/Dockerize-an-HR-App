<?php
    include_once "Web.php";
    require dirname(dirname(__FILE__)).'/Controllers/EmployeeController.php';
    
    //$controller = new EmployeeController();
    // die();
    $router = new Web();
    $router->addRoute('GET', '/employee', function () {
        return (new EmployeeController())->list();
    });

    $router->processRequest();
?>