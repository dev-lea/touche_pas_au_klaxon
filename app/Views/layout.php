<?php $flashes = \App\Core\Flash::get(); $appName = $app['name'] ?? 'TPAK'; ?>
<!doctype html>
<html lang="fr"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($appName) ?></title>
<link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="container py-4">
  <h1><?= htmlspecialchars($appName) ?></h1>
  <?php foreach($flashes as $f): ?>
    <div><?= htmlspecialchars($f['type'].': '.$f['msg']) ?></div>
  <?php endforeach; ?>
  <?php include __DIR__ . "/$view.php"; ?>
</body></html>
