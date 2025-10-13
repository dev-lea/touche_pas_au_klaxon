<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Flash;
use Symfony\Component\HttpFoundation\Response;
use App\Models\{User,Agency,Trip};

final class AdminController extends Controller
{
  private function guard(): ?Response {
    if (!Auth::isAdmin()) {
      Flash::set('danger', 'Accès réservé à l’administrateur');
      return $this->redirect('/');
    }
    return null;
  }

  public function dashboard(): Response {
    if ($r = $this->guard()) return $r;
    return $this->view('admin_dashboard', [
      'usersCount'    => count(User::all()),
      'agenciesCount' => count(Agency::all()),
      'tripsCount'    => count(Trip::listAll()),
    ]);
  }

  public function users(): Response {
    if ($r = $this->guard()) return $r;
    return $this->view('admin_users', ['users' => User::all()]);
  }

  public function agencies(): Response {
    if ($r = $this->guard()) return $r;
    return $this->view('admin_agencies', ['agencies' => Agency::all()]);
  }

  public function trips(): Response {
    if ($r = $this->guard()) return $r;
    return $this->view('admin_trips', ['trips' => Trip::listAll()]);
  }
}
