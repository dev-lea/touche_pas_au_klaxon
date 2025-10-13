<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Flash;
use Symfony\Component\HttpFoundation\Response;
use App\Models\{Trip, Agency};

final class TripController extends Controller
{
    public function createForm(): Response
    {
        if (!Auth::check()) return $this->redirect('/login');

        return $this->view('trip_form', [
            'agencies' => Agency::all(),
            'trip'     => null,
            'me'       => Auth::user(),
        ]);
    }

    public function store(): Response
    {
        if (!Auth::check()) return $this->redirect('/login');

        [$ok, $data, $err] = $this->validateTripInput($_POST);
        if (!$ok) {
            Flash::set('danger', $err);
            return $this->redirect('/trips/create');
        }

        try {
            $data['author_id'] = (int) Auth::id();
            Trip::create($data);
            Flash::set('success', 'Trajet créé.');
        } catch (\Throwable $e) {
            Flash::set('danger', 'Erreur création: '.$e->getMessage());
            return $this->redirect('/trips/create');
        }

        return $this->redirect('/');
    }

    public function editForm(int $id): Response
    {
        if (!Auth::check()) return $this->redirect('/login');

        $trip = Trip::find($id);
        if (!$trip) {
            Flash::set('danger', 'Trajet introuvable.');
            return $this->redirect('/');
        }
        if (!Auth::isAdmin() && (int)$trip['author_id'] !== (int)Auth::id()) {
            Flash::set('danger', 'Vous ne pouvez modifier que vos trajets.');
            return $this->redirect('/');
        }

        return $this->view('trip_form', [
            'trip'     => $trip,
            'agencies' => Agency::all(),
            'me'       => Auth::user(),
        ]);
    }

    public function update(int $id): Response
    {
        if (!Auth::check()) return $this->redirect('/login');

        $trip = Trip::find($id);
        if (!$trip) {
            Flash::set('danger', 'Trajet introuvable.');
            return $this->redirect('/');
        }
        if (!Auth::isAdmin() && (int)$trip['author_id'] !== (int)Auth::id()) {
            Flash::set('danger', 'Vous ne pouvez modifier que vos trajets.');
            return $this->redirect('/');
        }

        [$ok, $data, $err] = $this->validateTripInput($_POST);
        if (!$ok) {
            Flash::set('danger', $err);
            return $this->redirect('/trips/'.$id.'/edit');
        }

        try {
            Trip::update($id, $data);
            Flash::set('success', 'Trajet modifié.');
        } catch (\Throwable $e) {
            Flash::set('danger', 'Erreur modification: '.$e->getMessage());
            return $this->redirect('/trips/'.$id.'/edit');
        }

        return $this->redirect('/');
    }

    public function delete(int $id): Response
    {
        if (!Auth::check()) return $this->redirect('/login');

        $trip = Trip::find($id);
        if ($trip && (Auth::isAdmin() || (int)$trip['author_id'] === (int)Auth::id())) {
            Trip::delete($id);
            Flash::set('success', 'Trajet supprimé.');
        } else {
            Flash::set('danger', 'Suppression non autorisée.');
        }
        return $this->redirect('/');
    }

    /**
     * Valide et normalise les données du formulaire trajet.
     * @param array $src
     * @return array [bool ok, array data, string err]
     */
    private function validateTripInput(array $src): array
    {
        $from = isset($src['from_agency_id']) ? (int)$src['from_agency_id'] : 0;
        $to   = isset($src['to_agency_id'])   ? (int)$src['to_agency_id']   : 0;
        $dep  = trim((string)($src['depart_at']  ?? ''));
        $arr  = trim((string)($src['arrive_at']  ?? ''));
        $tot  = isset($src['seats_total'])      ? (int)$src['seats_total']      : 0;
        $ava  = isset($src['seats_available'])  ? (int)$src['seats_available']  : 0;

        if ($from <= 0 || $to <= 0)        return [false, [], 'Les agences sont requises.'];
        if ($from === $to)                 return [false, [], 'Départ et arrivée doivent être différents.'];
        if ($dep === '' || $arr === '')    return [false, [], 'Les dates de départ et d’arrivée sont requises.'];

        // convertit 'YYYY-MM-DDTHH:MM' => 'YYYY-MM-DD HH:MM:SS'
        $depDT = \DateTime::createFromFormat('Y-m-d\TH:i', $dep) ?: new \DateTime($dep);
        $arrDT = \DateTime::createFromFormat('Y-m-d\TH:i', $arr) ?: new \DateTime($arr);

        if ($depDT >= $arrDT)              return [false, [], 'On ne peut pas arriver avant (ou à) l’heure de départ.'];
        if ($tot <= 0)                     return [false, [], 'Les places totales doivent être ≥ 1.'];
        if ($ava < 0 || $ava > $tot)       return [false, [], 'Places disponibles incohérentes.'];

        return [true, [
            'from_agency_id'  => $from,
            'to_agency_id'    => $to,
            'depart_at'       => $depDT->format('Y-m-d H:i:s'),
            'arrive_at'       => $arrDT->format('Y-m-d H:i:s'),
            'seats_total'     => $tot,
            'seats_available' => $ava,
        ], ''];
    }
}
