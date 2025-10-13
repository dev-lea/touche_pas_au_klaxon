<?php
use App\Core\Auth;
$isAuth  = Auth::check();
$isAdmin = Auth::isAdmin();
?>
<h2 class="section-title">Trajets proposés</h2>

<div class="table-wrap">
  <table class="table table-striped mb-0 align-middle">
    <thead>
      <tr>
        <th>Départ</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Destination</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Places</th>
        <th class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php if (empty($trips)): ?>
      <tr><td colspan="8" class="text-center py-4">Aucun trajet disponible.</td></tr>
    <?php else: foreach ($trips as $t):
        $dep = new DateTime($t['depart_at']); $arr = new DateTime($t['arrive_at']);
        $modalId = 'tripModal'.$t['id'];
      ?>
      <tr>
        <td><?= htmlspecialchars($t['from_name']) ?></td>
        <td><?= $dep->format('d/m/Y') ?></td>
        <td><?= $dep->format('H:i') ?></td>
        <td><?= htmlspecialchars($t['to_name']) ?></td>
        <td><?= $arr->format('d/m/Y') ?></td>
        <td><?= $arr->format('H:i') ?></td>
        <td><?= (int)$t['seats_available'] ?></td>
        <td>
          <div class="action-inline justify-content-center">
            <?php if ($isAuth): ?>
              <!-- Bouton voir (modale) -->
              <a class="see" href="#" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>" title="Voir">
                <i class="bi bi-eye"></i>
              </a>
              <!-- Bouton edit/suppr uniquement pour l’auteur ou admin -->
              <?php if ($isAdmin || ($t['author_id'] ?? null) === (\App\Core\Auth::id())): ?>
                <a class="edit" href="/trips/<?= $t['id'] ?>/edit" title="Modifier"><i class="bi bi-pencil"></i></a>
                <form action="/trips/<?= $t['id'] ?>/delete" method="post" style="display:inline"
                      onsubmit="return confirm('Supprimer ce trajet ?');">
                  <button class="del" title="Supprimer"><i class="bi bi-trash"></i></button>
                </form>
              <?php endif; ?>
            <?php else: ?>
              <em>Connectez-vous</em>
            <?php endif; ?>
          </div>
        </td>
      </tr>

      <?php if ($isAuth): ?>
      <!-- MODALE détails -->
      <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Détails du trajet</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
              <p><strong>Auteur :</strong> <?= htmlspecialchars(($t['first_name']??'').' '.($t['last_name']??'')) ?></p>
              <p><strong>Téléphone :</strong> <?= htmlspecialchars($t['phone'] ?? '') ?></p>
              <p><strong>Email :</strong> <?= htmlspecialchars($t['email'] ?? '') ?></p>
              <p><strong>Nombre total de places :</strong> <?= (int)($t['seats_total'] ?? 0) ?></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

    <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>
