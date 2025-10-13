<h2 class="section-title">Agences</h2>
<div class="table-wrap">
  <table class="table table-striped mb-0">
    <thead><tr><th>ID</th><th>Nom</th></tr></thead>
    <tbody>
      <?php foreach ($agencies as $a): ?>
        <tr><td><?= (int)$a['id'] ?></td><td><?= htmlspecialchars($a['name']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
