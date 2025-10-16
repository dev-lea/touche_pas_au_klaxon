<?php
/** @var int $usersCount */
/** @var int $agenciesCount */
/** @var int $tripsCount */
?>
<h2 class="section-title">Tableau de bord</h2>
<div class="row g-3">
  <div class="col-md-4"><div class="card p-3"><strong>Utilisateurs</strong><div class="fs-3"><?= (int)$usersCount ?></div></div></div>
  <div class="col-md-4"><div class="card p-3"><strong>Agences</strong><div class="fs-3"><?= (int)$agenciesCount ?></div></div></div>
  <div class="col-md-4"><div class="card p-3"><strong>Trajets</strong><div class="fs-3"><?= (int)$tripsCount ?></div></div></div>
</div>
