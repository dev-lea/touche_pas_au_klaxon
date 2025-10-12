<?php
namespace App\Controllers;
use App\Core\Controller; use App\Core\Flash; use App\Core\Auth;
use App\Models\{Trip,Agency};

final class TripController extends Controller {
  public function createForm() {
    if(!Auth::check()) return $this->redirect('/login');
    $this->view('trip_form',['agencies'=>Agency::all(),'trip'=>null]);
  }
  private function validate(array $in): array {
    $from=(int)$in['from_agency_id']; $to=(int)$in['to_agency_id'];
    $dep=new \DateTime($in['depart_at']); $arr=new \DateTime($in['arrive_at']);
    $tot=max(1,(int)$in['seats_total']); $avail=max(0,(int)$in['seats_available']);
    if($from===$to) throw new \InvalidArgumentException("Départ et destination doivent être différents");
    if($arr <= $dep) throw new \InvalidArgumentException("On n'arrive pas avant de partir");
    if($avail > $tot) throw new \InvalidArgumentException("Places disponibles > total");
    return [
      'from'=>$from,'to'=>$to,'dep'=>$dep->format('Y-m-d H:i:s'),
      'arr'=>$arr->format('Y-m-d H:i:s'),'tot'=>$tot,'avail'=>$avail,'author'=>\App\Core\Auth::id()
    ];
  }
  public function store() {
    if(!Auth::check()) return $this->redirect('/login');
    try { $data=$this->validate($_POST); Trip::create($data);
      Flash::set('success','Le trajet a été créé'); } 
    catch(\Throwable $e){ Flash::set('danger',$e->getMessage()); }
    $this->redirect('/');
  }
  public function editForm($id) {
    if(!Auth::check()) return $this->redirect('/login');
    $trip=Trip::find((int)$id); $this->view('trip_form',['trip'=>$trip,'agencies'=>Agency::all()]);
  }
  public function update($id) {
    if(!Auth::check()) return $this->redirect('/login');
    try { $data=$this->validate($_POST); Trip::update((int)$id,$data);
      Flash::set('success','Le trajet a été modifié'); } 
    catch(\Throwable $e){ Flash::set('danger',$e->getMessage()); }
    $this->redirect('/');
  }
  public function delete($id) {
    if(!Auth::check()) return $this->redirect('/login');
    Trip::delete((int)$id,(int)\App\Core\Auth::id());
    Flash::set('success','Trajet supprimé');
    $this->redirect('/');
  }
}
