<?php $u=\App\Core\Auth::user(); ?>
<nav class="navbar navbar-expand bg-white shadow-sm rounded-pill px-3 mt-3">
  <a class="navbar-brand fw-semibold" href="/">Touche pas au klaxon</a>
  <div class="ms-auto d-flex align-items-center gap-2">
  <?php if(!$u): ?>
    <a class="btn btn-dark rounded-pill" href="/login">Connexion</a>
  <?php elseif(($u['role'] ?? 'user') === 'admin'): ?>
    <a class="btn btn-secondary rounded-pill" href="/admin">Tableau de bord</a>
    <a class="btn btn-dark rounded-pill" href="/logout">Déconnexion</a>
  <?php else: ?>
    <a class="btn btn-dark rounded-pill" href="/trips/create">Créer un trajet</a>
    <span>Bonjour <?= htmlspecialchars(($u['first_name']??'').' '.($u['last_name']??'')) ?></span>
    <a class="btn btn-dark rounded-pill" href="/logout">Déconnexion</a>
  <?php endif; ?>
  </div>
</nav>
