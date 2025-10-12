<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Trip;

final class HomeController extends Controller {
  public function index() {
    $trips = Trip::listPublic();
    $this->view('home', ['trips'=>$trips]);
  }
}
