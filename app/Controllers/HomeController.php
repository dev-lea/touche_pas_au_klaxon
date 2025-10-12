<?php
namespace App\Controllers;
use App\Core\Controller;

final class HomeController extends Controller {
  public function index() {
    $this->view('home', ['title'=>'Bienvenue']);
  }
}
