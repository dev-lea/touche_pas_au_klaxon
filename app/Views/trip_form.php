<?php $editing = !empty($trip); ?>
<h1><?= $editing?'Modifier':'Créer' ?> un trajet</h1>

<form method="post" action="<?= $editing? '/trips/'.$trip['id'] : '/trips' ?>" style="max-width:720px; display:grid; gap:12px;">
  <label>Agence de départ
    <select name="from_agency_id" required>
      <?php foreach($agencies as $a): ?>
        <option value="<?= $a['id'] ?>" <?= $editing && $trip['from_agency_id']==$a['id']?'selected':''; ?>>
          <?= htmlspecialchars($a['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Agence d'arrivée
    <select name="to_agency_id" required>
      <?php foreach($agencies as $a): ?>
        <option value="<?= $a['id'] ?>" <?= $editing && $trip['to_agency_id']==$a['id']?'selected':''; ?>>
          <?= htmlspecialchars($a['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Départ
    <input name="depart_at" type="datetime-local" required
           value="<?= $editing? date('Y-m-d\TH:i', strtotime($trip['depart_at'])) : '' ?>">
  </label>

  <label>Arrivée
    <input name="arrive_at" type="datetime-local" required
           value="<?= $editing? date('Y-m-d\TH:i', strtotime($trip['arrive_at'])) : '' ?>">
  </label>

  <label>Places totales
    <input name="seats_total" type="number" min="1" required value="<?= $trip['seats_total'] ?? 1 ?>">
  </label>

  <label>Places disponibles
    <input name="seats_available" type="number" min="0" required value="<?= $trip['seats_available'] ?? 1 ?>">
  </label>

  <button><?= $editing?'Enregistrer':'Créer' ?></button>
</form>
