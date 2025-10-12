<?php
namespace App\Core;
class Controller {
  protected function view(string $name, array $data = []) { View::render($name,$data); }
  protected function redirect(string $to) { header("Location: $to"); exit; }
}
