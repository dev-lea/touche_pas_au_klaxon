<?php
namespace App\Core;

final class View {
  public static function renderToString(string $view, array $data = []): string {
    extract($data);
    $app = ['name' => 'Touche pas au klaxon'];
    $viewFile = $view;
    ob_start();
    include __DIR__ . '/../Views/layout.php';
    return ob_get_clean();
  }
}
