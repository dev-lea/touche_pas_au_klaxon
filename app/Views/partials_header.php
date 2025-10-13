<?php
use App\Core\Auth;
$u = Auth::user();
$isAdmin = Auth::isAdmin();
?>
<header class="app-header">
  <a class="brand" href="<?= $isAdmin ? '/admin' : '/' ?>">Touche pas au klaxon</a>

  <?php if (!$u): ?>
    <div class="menu">
      <a class="pill" href="/login"><i class="bi bi-box-arrow-in-right"></i> Connexion</a>
    </div>

  <?php elseif ($isAdmin): ?>
    <div class="menu">
      <a class="pill outline" href="/admin/users">Utilisateurs</a>
      <a class="pill outline" href="/admin/agencies">Agences</a>
      <a class="pill outline" href="/admin/trips">Trajets</a>
      <span style="padding:.35rem .6rem; color:#6b7280;">
        Bonjour <?= htmlspecialchars($u['first_name'].' '.$u['last_name']) ?>
      </span>
      <a class="pill" href="/logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
    </div>

  <?php else: ?>
    <div class="menu">
      <a class="pill" href="/trips/create"><i class="bi bi-plus-lg"></i> Créer un trajet</a>
      <span style="padding:.35rem .6rem; color:#6b7280;">
        Bonjour <?= htmlspecialchars($u['first_name'].' '.$u['last_name']) ?>
      </span>
      <a class="pill" href="/logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
    </div>
  <?php endif; ?>
</header>
