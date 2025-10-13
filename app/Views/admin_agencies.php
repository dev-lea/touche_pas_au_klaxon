<h2 class="section-title">Agences</h2>

<div class="row g-3">
  <!-- Formulaire de création -->
  <div class="col-md-5">
    <div class="card p-3">
      <h5 class="mb-3">Créer une agence</h5>
      <form class="d-grid gap-2" method="post" action="/admin/agencies">
        <input type="hidden" name="op" value="create">
        <div>
          <label class="form-label">Nom de l’agence</label>
          <input class="form-control" type="text" name="name" required>
        </div>
        <button class="btn btn-primary">
          <i class="bi bi-plus-lg"></i> Créer
        </button>
      </form>
    </div>
  </div>

  <!-- Liste + inline edit -->
  <div class="col-md-7">
    <div class="table-wrap">
      <table class="table table-striped mb-0 align-middle">
        <thead>
          <tr><th style="width:80px">ID</th><th>Nom</th><th class="text-center" style="width:220px">Actions</th></tr>
        </thead>
        <tbody>
          <?php foreach ($agencies as $a): ?>
            <tr>
              <td><?= (int)$a['id'] ?></td>
              <td>
                <form class="d-flex gap-2" method="post" action="/admin/agencies">
                  <input type="hidden" name="op" value="update">
                  <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
                  <input class="form-control" type="text" name="name" value="<?= htmlspecialchars($a['name']) ?>" required>
                  <button class="btn btn-secondary" title="Renommer">
                    <i class="bi bi-pencil"></i>
                  </button>
                </form>
              </td>
              <td class="text-center">
                <form method="post" action="/admin/agencies" style="display:inline"
                      onsubmit="return confirm('Supprimer cette agence ?');">
                  <input type="hidden" name="op" value="delete">
                  <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
                  <button class="btn btn-danger">
                    <i class="bi bi-trash"></i> Supprimer
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (empty($agencies)): ?>
            <tr><td colspan="3" class="text-center py-4">Aucune agence</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
