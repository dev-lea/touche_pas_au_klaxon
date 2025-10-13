<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

final class AuthController extends Controller {
  public function loginForm(): Response {
    return $this->view('login', []);
  }

  public function login(): Response {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $pass  = $_POST['password'] ?? '';
    if (!$email || !$pass) {
      Flash::set('danger', 'Identifiants invalides');
      return $this->redirect('/login');
    }
    $u = User::findByEmail($email);
    if (!$u || !password_verify($pass, $u['password_hash'])) {
      Flash::set('danger', 'Email ou mot de passe incorrect');
      return $this->redirect('/login');
    }
    $_SESSION['user'] = $u;
    Flash::set('success', 'Connexion réussie');
    return $this->redirect('/');
  }

  public function logout(): Response {
    unset($_SESSION['user']);
    Flash::set('success', 'Déconnecté');
    return $this->redirect('/');
  }
}
