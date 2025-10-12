<?php
namespace App\Core;
final class View {
  public static function render(string $view, array $data=[]): void {
    extract($data);
    $app = require __DIR__.'/../../config/app.php';
    include __DIR__.'/../Views/layout.php';
  }
}
