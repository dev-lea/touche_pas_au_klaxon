<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Core\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\{Trip,Agency};

final class TripController extends Controller {
  public function createForm(): Response {
    if (!Auth::check()) return $this->redirect('/login');
    return $this->view('trip_form', ['agencies'=>Agency::all(), 'trip'=>null]);
  }

  private function validate(array $in): array {
    $from=(int)($in['from_agency_id'] ?? 0);
    $to=(int)($in['to_agency_id'] ?? 0);
    $dep=new \DateTime($in['depart_at'] ?? 'now');
    $arr=new \DateTime($in['arrive_at'] ?? 'now');
    $tot=max(1,(int)($in['seats_total'] ?? 1));
    $avail=max(0,(int)($in['seats_available'] ?? 0));
    if ($from === $to) throw new \InvalidArgumentException("Départ et destination doivent être différents");
    if ($arr <= $dep) throw new \InvalidArgumentException("On n'arrive pas avant de partir");
    if ($avail > $tot) throw new \InvalidArgumentException("Places disponibles > total");
    return [
      'from'=>$from,'to'=>$to,'dep'=>$dep->format('Y-m-d H:i:s'),
      'arr'=>$arr->format('Y-m-d H:i:s'),'tot'=>$tot,'avail'=>$avail,'author'=>Auth::id()
    ];
  }

  public function store(): Response {
    if (!Auth::check()) return $this->redirect('/login');
    try { $data=$this->validate($_POST); Trip::create($data); Flash::set('success','Trajet créé'); }
    catch (\Throwable $e) { Flash::set('danger',$e->getMessage()); }
    return $this->redirect('/');
  }

  public function editForm($id): Response {
    if (!Auth::check()) return $this->redirect('/login');
    $trip = Trip::find((int)$id);
    return $this->view('trip_form', ['trip'=>$trip, 'agencies'=>Agency::all()]);
  }

  public function update($id): Response {
    if (!Auth::check()) return $this->redirect('/login');
    try { $data=$this->validate($_POST); Trip::update((int)$id,$data); Flash::set('success','Trajet modifié'); }
    catch (\Throwable $e) { Flash::set('danger',$e->getMessage()); }
    return $this->redirect('/');
  }

  public function delete($id): Response {
    if (!Auth::check()) return $this->redirect('/login');
    Trip::delete((int)$id, (int)Auth::id(), Auth::isAdmin());
    Flash::set('success', 'Trajet supprimé');
    return $this->redirect('/');
  }
}
