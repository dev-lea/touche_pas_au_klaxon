<?php
/** @var array $trips */
$trips = $trips ?? [];
use App\Core\Auth;
?>

<h2 class="section-title">Trajets (administration)</h2>

<div class="table-wrap">
  <table class="table table-striped mb-0 align-middle">
    <thead>
      <tr>
        <th>De</th>
        <th>À</th>
        <th>Départ</th>
        <th>Arrivée</th>
        <th>Places dispo</th>
        <th class="text-center" style="width:210px">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($trips as $t): ?>
        <?php
          $id       = (int)($t['id'] ?? 0);
          // Fallbacks pour éviter tout warning si une clé manque encore
          $fromName = $t['from_name'] ?? ('#' . ($t['from_agency_id'] ?? '?'));
          $toName   = $t['to_name']   ?? ('#' . ($t['to_agency_id']   ?? '?'));
          $depart   = isset($t['depart_at']) ? date('d/m/Y H:i', strtotime($t['depart_at'])) : '';
          $arrive   = isset($t['arrive_at']) ? date('d/m/Y H:i', strtotime($t['arrive_at'])) : '';
          $avail    = (int)($t['seats_available'] ?? 0);
          $total    = (int)($t['seats_total'] ?? 0);
          $modalId  = 'tripModalAdmin'.$id;
          $author   = trim(($t['first_name'] ?? '').' '.($t['last_name'] ?? ''));
          $phone    = $t['phone'] ?? '';
          $email    = $t['email'] ?? '';
        ?>
        <tr>
          <td><?= htmlspecialchars($fromName) ?></td>
          <td><?= htmlspecialchars($toName) ?></td>
          <td><?= htmlspecialchars($depart) ?></td>
          <td><?= htmlspecialchars($arrive) ?></td>
          <td><?= $avail ?></td>
          <td class="text-center">
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
              <i class="bi bi-eye"></i>
            </button>
            <a class="btn btn-secondary" href="/trips/<?= $id ?>/edit" title="Modifier">
              <i class="bi bi-pencil"></i>
            </a>
            <form method="post" action="/trips/<?= $id ?>/delete" style="display:inline-block;margin-left:4px"
                  onsubmit="return confirm('Supprimer ce trajet ?');">
              <button class="btn btn-danger" title="Supprimer">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>

        <!-- Modale détails -->
        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                  Détails — <?= htmlspecialchars($fromName) ?> → <?= htmlspecialchars($toName) ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
              </div>
              <div class="modal-body">
                <ul class="list-unstyled mb-0">
                  <li><strong>Auteur :</strong> <?= htmlspecialchars($author) ?></li>
                  <li><strong>Téléphone :</strong> <?= htmlspecialchars($phone) ?></li>
                  <li><strong>Email :</strong> <?= htmlspecialchars($email) ?></li>
                  <li><strong>Places totales :</strong> <?= $total ?></li>
                  <li><strong>Places dispo :</strong> <?= $avail ?></li>
                  <li><strong>Départ :</strong> <?= htmlspecialchars($depart) ?></li>
                  <li><strong>Arrivée :</strong> <?= htmlspecialchars($arrive) ?></li>
                </ul>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              </div>
            </div>
          </div>
        </div>

      <?php endforeach; ?>

      <?php if (empty($trips)): ?>
        <tr><td colspan="6" class="text-center py-4">Aucun trajet</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
