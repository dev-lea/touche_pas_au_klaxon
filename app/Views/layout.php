<?php $appName = 'Touche pas au klaxon'; ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($appName) ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="/assets/css/app.css">
  <!-- Bootstrap Icons (pour de jolies icônes) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
  <div class="app-shell">
    <?php include __DIR__.'/partials_header.php'; ?>
    <main class="mt-3">
      <?php include __DIR__.'/partials_flash.php'; ?>
      <?php include __DIR__ . "/{$viewFile}.php"; ?>
    </main>
    <?php include __DIR__.'/partials_footer.php'; ?>
  </div>

  <!-- Bootstrap JS pour la modale -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
