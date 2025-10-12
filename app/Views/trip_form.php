<?php $editing = !empty($trip); ?>
<h2 class="mt-3"><?= $editing?'Modifier':'Créer' ?> un trajet</h2>
<form method="post" action="<?= $editing? '/trips/'.$trip['id'] : '/trips' ?>">
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Agence de départ</label>
      <select name="from_agency_id" class="form-select" required>
        <?php foreach($agencies as $a): ?>
          <option value="<?= $a['id'] ?>" <?= $editing && $trip['from_agency_id']==$a['id']?'selected':''; ?>>
            <?= htmlspecialchars($a['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Agence d'arrivée</label>
      <select name="to_agency_id" class="form-select" required>
        <?php foreach($agencies as $a): ?>
          <option value="<?= $a['id'] ?>" <?= $editing && $trip['to_agency_id']==$a['id']?'selected':''; ?>>
            <?= htmlspecialchars($a['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-6"><label class="form-label">Départ</label>
      <input name="depart_at" type="datetime-local" class="form-control" required
             value="<?= $editing? date('Y-m-d\TH:i',strtotime($trip['depart_at'])):'' ?>">
    </div>
    <div class="col-md-6"><label class="form-label">Arrivée</label>
      <input name="arrive_at" type="datetime-local" class="form-control" required
             value="<?= $editing? date('Y-m-d\TH:i',strtotime($trip['arrive_at'])):'' ?>">
    </div>
    <div class="col-md-6"><label class="form-label">Places totales</label>
      <input name="seats_total" type="number" min="1" class="form-control" required value="<?= $trip['seats_total']??1 ?>">
    </div>
    <div class="col-md-6"><label class="form-label">Places disponibles</label>
      <input name="seats_available" type="number" min="0" class="form-control" required value="<?= $trip['seats_available']??1 ?>">
    </div>
  </div>
  <button class="btn btn-dark mt-3"><?= $editing?'Enregistrer':'Créer' ?></button>
</form>
