<h2 class="section-title">Connexion</h2>
<div class="card p-4" style="max-width:520px;">
  <form method="post" action="/login" class="d-grid gap-3">
    <div>
      <label class="form-label">Adresse email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div>
      <label class="form-label">Mot de passe</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button class="btn btn-primary">Se connecter</button>
  </form>
  <p class="mt-3 small text-muted">
    Comptes de test : <br>
    Admin — <code>alexandre.martin@email.fr</code> / <code>Password!23</code><br>
    User — <code>sophie.dubois@email.fr</code> / <code>Password!23</code>
  </p>
</div>
