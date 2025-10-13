<?php foreach (\App\Core\Flash::get() as $f): ?>
  <div style="margin:10px 0; padding:10px; border-radius:8px; background:<?= $f['type']==='success'?'#d1e7dd':'#f8d7da' ?>;">
    <?= htmlspecialchars($f['msg']) ?>
  </div>
<?php endforeach; ?>
