<?php
namespace App\Controllers;

use Core\View;
use App\Models\User;

class HomeController {
  public function index() {
    User::create([
      'name' => 'gonzalo',
      'email' => 'gonzalo@gmail.com',
      'role' => 'admin',
      'password' => password_hash('admin123', PASSWORD_DEFAULT)
    ]);
    User::create([
      'name' => 'daniel',
      'email' => 'daniel@gmail.com',
      'role' => 'admin',
      'password' => password_hash('user123', PASSWORD_DEFAULT)
    ]);
    return View::render(
    template: 'home/index', 
    data: ['message' => 'hello!'],
    layout: 'layouts/main');
  }
}