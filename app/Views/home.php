<?php $isAuth = \App\Core\Auth::check(); $isAdmin = \App\Core\Auth::isAdmin(); ?>
<h2 class="mt-3">Trajets disponibles</h2>
<div class="table-responsive">
<table class="table align-middle table-striped">
  <thead class="table-dark">
    <tr>
      <th>Départ</th><th>Date</th><th>Heure</th>
      <th>Arrivée</th><th>Date</th><th>Heure</th>
      <th>Places</th><th class="text-end">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach(($trips ?? []) as $t):
    $dep = new DateTime($t['depart_at']); $arr = new DateTime($t['arrive_at']); ?>
    <tr>
      <td><?= htmlspecialchars($t['from_name']) ?></td>
      <td><?= $dep->format('d/m/Y') ?></td>
      <td><?= $dep->format('H:i') ?></td>
      <td><?= htmlspecialchars($t['to_name']) ?></td>
      <td><?= $arr->format('d/m/Y') ?></td>
      <td><?= $arr->format('H:i') ?></td>
      <td><?= (int)$t['seats_available'] ?></td>
      <td class="text-end">
        <?php if($isAuth): ?>
          <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#d<?= $t['id'] ?>">Détails</button>
          <?php if($t['author_id'] == (\App\Core\Auth::id()) || $isAdmin): ?>
            <a class="btn btn-sm btn-outline-secondary" href="/trips/<?= $t['id'] ?>/edit">✏️</a>
            <form action="/trips/<?= $t['id'] ?>/delete" method="post" class="d-inline" onsubmit="return confirm('Supprimer ?');">
              <button class="btn btn-sm btn-outline-danger">🗑</button>
            </form>
          <?php endif; ?>
        <?php endif; ?>
      </td>
    </tr>
    <?php if($isAuth): ?>
    <div class="modal fade" id="d<?= $t['id'] ?>" tabindex="-1">
      <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Détails</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <p><strong>Auteur :</strong> <?= htmlspecialchars($t['first_name'].' '.$t['last_name']) ?></p>
          <p><strong>Téléphone :</strong> <?= htmlspecialchars($t['phone']) ?></p>
          <p><strong>Email :</strong> <?= htmlspecialchars($t['email']) ?></p>
          <p><strong>Places totales :</strong> <?= (int)$t['seats_total'] ?></p>
        </div>
        <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button></div>
      </div></div>
    </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php if(!$isAuth): ?>
  <p class="lead mt-3">Connectez-vous pour voir les détails des trajets.</p>
<?php endif; ?>
