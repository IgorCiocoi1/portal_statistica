<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {
  case 'educatie':
    require_once 'controllers/EducatieController.php';
    $controller = new EducatieController();
    $controller->index();
    break;

  default:
    require_once 'controllers/HomeController.php';
    $controller = new HomeController();
    $controller->index();
    break;
}
