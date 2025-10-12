<?php $appName = ($app['name'] ?? 'Touche pas au klaxon'); ?>
<!doctype html>
<html lang="fr"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($appName) ?></title>
<link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="d-flex flex-column min-vh-100">
  <?php include __DIR__.'/partials_header.php'; ?>
  <main class="container my-4">
    <?php include __DIR__.'/partials_flash.php'; ?>
    <?php include __DIR__ . "/$view.php"; ?>
  </main>
  <?php include __DIR__.'/partials_footer.php'; ?>
  <script type="module" src="/assets/js/app.js"></script>
</body></html>
