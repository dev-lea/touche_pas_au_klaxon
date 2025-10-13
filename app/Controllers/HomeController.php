<?php
namespace App\Controllers;

use App\Core\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Trip;

final class HomeController extends Controller {
  public function index(): Response {
    try {
      $trips = Trip::listPublic(); // trajets futurs avec places > 0
      return $this->view('home', ['trips' => $trips, 'title' => 'Trajets disponibles']);
    } catch (\Throwable $e) {
      $msg = "HOME ERROR: " . $e->getMessage() . " @ " . $e->getFile() . ":" . $e->getLine();
      // On renvoie un Response texte pour voir l'erreur réelle
      return new Response($msg, 500, ['Content-Type' => 'text/plain; charset=utf-8']);
    }
  }
}
