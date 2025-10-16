<?php
/** @var array $agencies */
$agencies = $agencies ?? [];
?>

<?php
$editing = !empty($trip);
$me = $me ?? \App\Core\Auth::user(); // par sécurité si non passé
?>
<h1 class="section-title"><?= $editing ? 'Modifier' : 'Créer' ?> un trajet</h1>

<div class="row g-3">
  <!-- Bloc identité (lecture seule) -->
  <div class="col-lg-4">
    <div class="card p-3">
      <h5 class="mb-3">Vos informations</h5>
      <div class="mb-2"><strong>Nom</strong><br><?= htmlspecialchars(($me['last_name'] ?? '')) ?></div>
      <div class="mb-2"><strong>Prénom</strong><br><?= htmlspecialchars(($me['first_name'] ?? '')) ?></div>
      <div class="mb-2"><strong>Email</strong><br><?= htmlspecialchars(($me['email'] ?? '')) ?></div>
      <div class="mb-2"><strong>Téléphone</strong><br><?= htmlspecialchars(($me['phone'] ?? '')) ?></div>
      <p class="small text-muted mb-0">Ces informations sont issues de l’annuaire et ne sont pas modifiables ici.</p>
    </div>
  </div>

  <!-- Formulaire trajet -->
  <div class="col-lg-8">
    <div class="card p-3">
      <form method="post" action="<?= $editing ? '/trips/'.$trip['id'] : '/trips' ?>" class="d-grid gap-3">

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Agence de départ</label>
            <select name="from_agency_id" class="form-select" required>
              <?php foreach($agencies as $a): ?>
                <option value="<?= $a['id'] ?>" <?= $editing && (int)$trip['from_agency_id']===(int)$a['id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($a['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Agence d'arrivée</label>
            <select name="to_agency_id" class="form-select" required>
              <?php foreach($agencies as $a): ?>
                <option value="<?= $a['id'] ?>" <?= $editing && (int)$trip['to_agency_id']===(int)$a['id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($a['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Départ</label>
            <input name="depart_at" type="datetime-local" class="form-control" required
                   value="<?= $editing ? date('Y-m-d\TH:i', strtotime($trip['depart_at'])) : '' ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label">Arrivée</label>
            <input name="arrive_at" type="datetime-local" class="form-control" required
                   value="<?= $editing ? date('Y-m-d\TH:i', strtotime($trip['arrive_at'])) : '' ?>">
          </div>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Places totales</label>
            <input name="seats_total" type="number" min="1" class="form-control" required
                   value="<?= $editing ? (int)$trip['seats_total'] : 1 ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label">Places disponibles</label>
            <input name="seats_available" type="number" min="0" class="form-control" required
                   value="<?= $editing ? (int)$trip['seats_available'] : 1 ?>">
          </div>
        </div>

        <div class="d-flex gap-2">
          <button class="btn btn-primary"><?= $editing ? 'Enregistrer les modifications' : 'Créer le trajet' ?></button>
          <a class="btn btn-secondary" href="/">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</div>
