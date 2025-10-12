<h2 class="mt-3">Tableau de bord Admin</h2>

<h4 class="mt-4">Agences</h4>
<form class="d-flex gap-2" method="post" action="/admin/agencies">
  <input name="name" class="form-control" placeholder="Nouvelle agence">
  <button class="btn btn-dark">Ajouter</button>
</form>
<ul class="list-group mt-3">
  <?php foreach($agencies as $a): ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <form class="d-flex gap-2" method="post" action="/admin/agencies/<?= $a['id'] ?>">
        <input name="name" class="form-control" value="<?= htmlspecialchars($a['name']) ?>">
        <button class="btn btn-secondary">Modifier</button>
      </form>
      <form method="post" action="/admin/agencies/<?= $a['id'] ?>/delete" onsubmit="return confirm('Supprimer ?')">
        <button class="btn btn-outline-danger">Supprimer</button>
      </form>
    </li>
  <?php endforeach; ?>
</ul>

<h4 class="mt-5">Trajets</h4>
<table class="table table-striped">
  <thead class="table-dark"><tr><th>ID</th><th>From</th><th>To</th><th>Départ</th><th>Places</th><th></th></tr></thead>
  <tbody>
  <?php foreach($trips as $t): ?>
    <tr>
      <td><?= $t['id'] ?></td>
      <td><?= $t['from_agency_id'] ?></td>
      <td><?= $t['to_agency_id'] ?></td>
      <td><?= date('d/m/Y H:i',strtotime($t['depart_at'])) ?></td>
      <td><?= $t['seats_available'].'/'.$t['seats_total'] ?></td>
      <td>
        <form action="/trips/<?= $t['id'] ?>/delete" method="post" onsubmit="return confirm('Supprimer ?')">
          <button class="btn btn-sm btn-outline-danger">🗑</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
