<?php
namespace App\Controllers;
use App\Core\Controller; use App\Core\Flash;
use App\Models\{Agency,Trip};

final class AdminController extends Controller {
  private function guard() {
    $u = $_SESSION['user'] ?? null;
    if(!$u || ($u['role'] ?? 'user') !== 'admin') $this->redirect('/');
  }
  public function dashboard() {
    $this->guard();
    $this->view('admin_dashboard',[
      'agencies'=>Agency::all(),
      'trips'=>Trip::listAll()
    ]);
  }
  public function storeAgency() { $this->guard();
    $name=trim($_POST['name']??''); if($name===''){ Flash::set('danger','Nom requis'); }
    else { Agency::create($name); Flash::set('success','Agence créée'); }
    $this->redirect('/admin');
  }
  public function updateAgency($id){ $this->guard();
    $name=trim($_POST['name']??''); if($name===''){ Flash::set('danger','Nom requis'); }
    else { Agency::update((int)$id,$name); Flash::set('success','Agence modifiée'); }
    $this->redirect('/admin');
  }
  public function deleteAgency($id){ $this->guard(); Agency::delete((int)$id);
    Flash::set('success','Agence supprimée'); $this->redirect('/admin'); }
}
