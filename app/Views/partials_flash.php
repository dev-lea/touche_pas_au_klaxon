<?php $flashes = \App\Core\Flash::get(); ?>
<?php foreach($flashes as $f): ?>
  <div class="alert alert-<?= htmlspecialchars($f['type']) ?> rounded-pill mt-3">
    <?= htmlspecialchars($f['msg']) ?>
  </div>
<?php endforeach; ?>
