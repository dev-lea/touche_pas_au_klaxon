<?php
namespace App\Core;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Controller {
  protected function view(string $name, array $data = []): Response {
    $html = View::renderToString($name, $data);
    return new Response($html, 200, ['Content-Type' => 'text/html; charset=utf-8']);
  }
  protected function redirect(string $to): Response {
    return new RedirectResponse($to, 302);
  }
}
