<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Flash;
use Symfony\Component\HttpFoundation\Response;
use App\Models\{User, Agency, Trip};

final class AdminController extends Controller
{
    /** Protège les pages admin, redirige si non-admin */
    private function guard(): ?Response
    {
        if (!Auth::isAdmin()) {
            Flash::set('danger', 'Accès réservé à l’administrateur');
            return $this->redirect('/');
        }
        return null;
    }

    /** Tableau de bord */
    public function dashboard(): Response
    {
        if ($r = $this->guard()) return $r;

        return $this->view('admin_dashboard', [
            'usersCount'    => count(User::all()),
            'agenciesCount' => count(Agency::all()),
            'tripsCount'    => count(Trip::listAll()),
        ]);
    }

    /** Liste des utilisateurs */
    public function users(): Response
    {
        if ($r = $this->guard()) return $r;

        return $this->view('admin_users', [
            'users' => User::all(),
        ]);
    }

    /** Liste/CRUD agences (page) */
    public function agencies(): Response
    {
        if ($r = $this->guard()) return $r;

        return $this->view('admin_agencies', [
            'agencies' => Agency::all(),
        ]);
    }

    /** POST unique agences: create/update/delete via $_POST['op'] */
    public function agenciesPost(): Response
    {
        if ($r = $this->guard()) return $r;

        $op   = $_POST['op'] ?? 'create';
        $name = trim((string)($_POST['name'] ?? ''));
        $id   = isset($_POST['id']) ? (int)$_POST['id'] : null;

        try {
            switch ($op) {
                case 'create':
                    if ($name === '') throw new \InvalidArgumentException('Le nom de l’agence est requis.');
                    Agency::create($name);
                    Flash::set('success', 'Agence créée.');
                    break;

                case 'update':
                    if (!$id) throw new \InvalidArgumentException('ID manquant.');
                    if ($name === '') throw new \InvalidArgumentException('Le nom de l’agence est requis.');
                    Agency::update($id, $name);
                    Flash::set('success', 'Agence modifiée.');
                    break;

                case 'delete':
                    if (!$id) throw new \InvalidArgumentException('ID manquant.');
                    Agency::delete($id);
                    Flash::set('success', 'Agence supprimée.');
                    break;

                default:
                    Flash::set('danger', 'Action inconnue.');
            }
        } catch (\Throwable $e) {
            Flash::set('danger', 'Erreur: '.$e->getMessage());
        }

        return $this->redirect('/admin/agencies');
    }

    /** Trajets (ADMIN) — vue dédiée admin_trips (même présentation que home) */
    public function trips(): Response
    {
        if ($r = $this->guard()) return $r;

        return $this->view('admin_trips', [
            'trips' => Trip::listAll(), // tous les trajets (passés inclus) avec JOINS
        ]);
    }
}
