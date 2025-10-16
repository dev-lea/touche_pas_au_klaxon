<?php
/** @var array $users */
$users = $users ?? [];
?>

<h2 class="section-title">Utilisateurs</h2>
<div class="table-wrap">
  <table class="table table-striped mb-0">
    <thead><tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th><th>Rôle</th></tr></thead>
    <tbody>
      <?php foreach ($users as $u): ?>
        <tr>
          <td><?= htmlspecialchars($u['last_name']) ?></td>
          <td><?= htmlspecialchars($u['first_name']) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td><?= htmlspecialchars($u['phone']) ?></td>
          <td><?= htmlspecialchars($u['role']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
