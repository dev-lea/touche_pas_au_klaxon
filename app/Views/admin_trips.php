<h2 class="section-title">Trajets</h2>
<div class="table-wrap">
  <table class="table table-striped mb-0">
    <thead>
      <tr><th>ID</th><th>Départ</th><th>Destination</th><th>Départ</th><th>Arrivée</th><th>Places</th></tr>
    </thead>
    <tbody>
      <?php foreach ($trips as $t): ?>
        <tr>
          <td><?= (int)$t['id'] ?></td>
          <td><?= (int)$t['from_agency_id'] ?></td>
          <td><?= (int)$t['to_agency_id'] ?></td>
          <td><?= htmlspecialchars($t['depart_at']) ?></td>
          <td><?= htmlspecialchars($t['arrive_at']) ?></td>
          <td><?= (int)$t['seats_available'] ?>/<?= (int)$t['seats_total'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
