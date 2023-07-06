<?php
session_start();
require_once "autoload/autoload.php";
require_once "config/parameter.php";
require_once "config/ConnectionDb.php";
require_once "views/includes/header.php";
function error()
{
               $error = new ErrorController();
               $error->index();
}

if (isset($_GET["controller"])) {
               $controllerName = $_GET['controller'] . "Controller";
} elseif (!isset($_GET["controller"]) && !isset($_GET["action"])) {
               $controllerName = default_controller;
} else {
               error();
               exit();
}
if (class_exists($controllerName)) {
               $controller = new $controllerName();
               if (isset($_GET["action"]) && method_exists($controller, $_GET["action"])) {
                              $action = $_GET["action"];
                              $controller->$action();
               } elseif (!isset($_GET["controller"]) && !isset($_GET["action"])) {
                              $action = default_action;
                              $controller->$action();
               } else {
                              error();
               }
} else {
               error();
}
require_once "views/includes/footer.php";
