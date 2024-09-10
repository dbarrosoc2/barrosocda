<form action="<?= $url_base ?>controllers/login-manage.php" method="POST" class="row g-3 needs-validation" novalidate>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" id="user" name="user" class="form-control" required placeholder="Usuario o Correo">
            <label for="user">Usuario o Correo</label>
            <div class="invalid-feedback">Ingresa tu correo o nombre de usuario.</div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="password" id="password" name="pass" class="form-control" required placeholder="Contraseña">
            <label for="password">Contraseña</label>
            <div class="invalid-feedback">Ingresa tu correo o nombre de usuario.</div>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Acceder a área de usuario</button>
    </div>
</form>