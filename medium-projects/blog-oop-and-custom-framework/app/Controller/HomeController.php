<?php
namespace App\Controller;

use Core\View;
use Exception;

class HomeController {
  public function index() {
    return View::render(
    template: 'home/index', 
    data: ['message' => 'hello!'],
    layout: 'layouts/main');
  }
}